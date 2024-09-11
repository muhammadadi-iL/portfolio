<?php

namespace App\Services;

use App\Helpers\APIResponse;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserService
{

//    /**
//     * @var UserRepository
//     */
//
//    protected $userRepository;
//
//    /**
//     * @param UserRepository $userRepository
//     */
//    public function __construct(UserRepository $userRepository)
//    {
//        $this->userRepository = $userRepository;
//    }

    public function registerUser(array $data): array
    {
        $user = new User();

        $user->user_name = $data['user_name'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];
        $user->password = $data['password'];

        $user->save();
        $token = $user->createToken('MyApp')->plainTextToken;
        Auth::login($user);

        return [
            'success' => true,
            'message' => 'User Register Successfully',
            'data' => $user,
            'access_token' => $token
        ];
    }

    public function authenticateUser(array $data): array
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $token = Auth::user()->createToken('MyApp')->plainTextToken;
            $user = User::where('id', Auth::user()->id)->first();
            $user->save();

            $userData = User::find($user->id);
            if ($userData) {
                foreach ($userData->getAttributes() as $key => $value) {
                    if (is_null($value)) {
                        $userData->{$key} = "";
                    }
                }
            }

            return [
                'success' => true,
                'message' => 'Logged In Successfully',
                'data' => $userData,
                'access_token' => $token
            ];
        } else {
            dd(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]));
            return [
                'success' => false,
                'error' => 'Unauthorized',
            ];
        }
    }

    public function logoutUser($user): array
    {
        dd($user);
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return [
            'success' => true,
            'message' => 'Logout successfully',
        ];
    }

    public function resetEmail($email, $type = null): bool|Exception
    {
        try {
            $user = $this->userRepository->findByField('email', $email)->first();

            if (!$user) {
                throw new Exception('User Not Found');
            }
            $encryptedId = encrypt($user->id);

            $otp = (string)rand(1111, 9999);
            $user = $this->userRepository->storeOTP($user->id, $otp);

            $to = $user->email;
            $from = 'noreply@gmail.com';
            $subject = "Forgot Password";
            $message = view('vendor.user.otp-email', compact('otp', 'encryptedId', 'type'));

            // $this->customMail($from, $to, $subject, $message);
            send_mail($from, $to, $subject, $message);
            return true;

        } catch (Exception $e) {
            Log::error('Error in ResetEmail: ' . $e->getMessage());
            return $e;
        }
    }

    public function optExist($userId)
    {
        return $this->userRepository->findByField('id', $userId)->first();
    }

    public function verifyOtp($email, $otp)
    {

        try {
            $user = $this->userRepository->findByField('email', $email)->first();
            if ($user) {
                $encryptedId = encrypt($user->id);
                if ($user->otp == $otp || $user->otp_expire > Carbon::now()) {
                    $this->userRepository->resetOTP($user->id, null, null);
                    return APIResponse::success('OTP successfully verify.', $encryptedId, 200);
                } else {
                    throw new Exception('Otp is expired please regenerate');
                }
            }
        } catch (Exception $e) {
            Log::error('Error in ResetEmail: ' . $e->getMessage());
            return $e;
        }
    }

    /**
     * @throws Exception
     */
    public function resetPassword($email, $password): JsonResponse
    {
        $user = $this->userRepository->findByField('email', $email)->first();
        if ($user) {
            $userPassword = Hash::make($password);
            $this->userRepository->resetPassword($user->id, $userPassword);

            return APIResponse::success('Password reset Successfully', [], 200);
        } else {
            throw new Exception('User does not exist');
        }
    }
}
