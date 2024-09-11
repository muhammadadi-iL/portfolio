<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserApiLoginFromRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:api');
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $minutes = 60;
            $password = Hash::make($request->input('password'));
            $array = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];
            $authResult = $this->userService->authenticateUser($array);

            return response()->json($authResult)->withCookie(cookie('token', $authResult['access_token'], $minutes));
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }



    public function userLogout(Request $request): JsonResponse
    {
        dd('here');
        $request->user()->token()->revoke();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    public function losgout(Request $request): JsonResponse
    {
        try {
            $response = $this->userService->logoutUser(Auth::user());
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e,
            ]);
        }
    }
}
