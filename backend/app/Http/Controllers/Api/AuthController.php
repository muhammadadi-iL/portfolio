<?php

namespace App\Http\Controllers\Api;

use App\Helpers\APIResponse;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */

    protected UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User login",
     *     tags={"Authentication"},
     *     requestBody={
     *         "description": "User login",
     *         "required": true,
     *         "content": {
     *             "application/json": {
     *                 "schema": {
     *                     "type": "object",
     *                     "properties": {
     *                         "email": {
     *                             "type": "string",
     *                             "example": "john@gmail.com",
     *                         },
     *                         "password": {
     *                             "type": "string",
     *                             "example": "12345678",
     *                         },
     *                     },
     *                 },
     *             },
     *         },
     *     },
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="OK",
     *             @OA\JsonContent(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                     example=true,
     *                     description="A boolean value."
     *                 ),
     *             ),
     *         ),
     *     },
     * )
     */
    public function authenticate(Request $request)
    {
        try {
            $minutes = 60;
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->messages()
                ]);
            }

            if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $auth_user = Auth::user();
                $user_login_token = JWTAuth::fromUser($auth_user);
                $user = User::select('id', 'name', 'email')->where('id', auth()->user()->id)->first();
                $user->save();

                $userData = User::find(auth()->user()->id);
                if ($userData) {
                    foreach ($userData->getAttributes() as $key => $value) {
                        if (is_null($value)) {
                            $userData->{$key} = "";
                        }
                    }
                }

                return response()->json([
                    'success' => true,
                    'response' => $userData,
                    'access_token' => $user_login_token,
                ])->withCookie(cookie('token', $user_login_token, $minutes));
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="User Register",
     *     tags={"Authentication"},
     *     requestBody={
     *         "description": "User Register",
     *         "required": true,
     *         "content": {
     *             "application/json": {
     *                 "schema": {
     *                     "type": "object",
     *                     "properties": {
     *                         "user_name": {
     *                             "type": "string",
     *                             "example": "Smith-john21",
     *                          },
     *                         "name": {
     *                             "type": "string",
     *                             "example": "John",
     *                         },
     *                         "email": {
     *                             "type": "string",
     *                             "example": "john@gmail.com",
     *                         },
     *                         "password": {
     *                             "type": "string",
     *                             "example": "12345678",
     *                         },
     *                          "role_id": {
     *                              "type": "integer",
     *                              "example": 2,
     *                          },
     *                     },
     *                 },
     *             },
     *         },
     *     },
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="OK",
     *             @OA\JsonContent(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                     example=true,
     *                     description="A boolean value."
     *                 ),
     *             ),
     *         ),
     *     },
     * )
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ]);
        }

        $user = User::create([
            'user_name' => $request->input('user_name'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => 2,
            'password' => Hash::make($request->input('password'))
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token, $user);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="User Logout",
     *     tags={"Authentication"},
     *     requestBody={
     *         "description": "User Logout",
     *         "required": true,
     *         "content": {
     *             "application/json": {
     *                 "schema": {
     *                     "type": "object",
     *                 },
     *             },
     *         },
     *     },
     *     responses={
     *         @OA\Response(
     *             response=200,
     *             description="OK",
     *             @OA\JsonContent(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean",
     *                     example=true,
     *                     description="A boolean value."
     *                 ),
     *             ),
     *         ),
     *     },
     * )
     */
    public function logout(): JsonResponse
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token, $user): JsonResponse
    {
        $userData = $user->only([
            'id',
            'user_name',
            'name',
            'email',
            'profile_photo_url',
        ]);

        if ($userData) {
            foreach ($userData as $key => $value) {
                if (is_null($value)) {
                    $userData[$key] = "";
                }
            }
        }

        return response()->json([
            'user_data' => $userData,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    /**
     * @throws \Exception
     */
    public function resetEmail($email, $type = null): bool|Exception
    {
        try {
            $user = $this->userRepository->findByField('email', $email)->first();

            if (!$user) {
                throw new \Exception('User Not Found');
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

    public function otpExist($userId)
    {
        return $this->userRepository->findByField('id', $userId)->first();
    }

    /**
     * @throws \Exception
     */
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
                    throw new \Exception('Otp is expired please regenerate');
                }
            }
        } catch (Exception $e) {
            Log::error('Error in ResetEmail: ' . $e->getMessage());
            return $e;
        }
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function resetPassword($email, $password): JsonResponse
    {
        $user = $this->userRepository->findByField('email', $email)->first();
        if ($user) {
            $userPassword = Hash::make($password);
            $this->userRepository->resetPassword($user->id, $userPassword);

            return APIResponse::success('Password reset Successfully', [], 200);
        } else {
            throw new \Exception('User does not exist');
        }
    }
}
