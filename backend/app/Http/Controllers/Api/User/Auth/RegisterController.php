<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Helpers\APIResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserApiLoginFromRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }



    public function register(UserApiLoginFromRequest $request): JsonResponse
    {
        try {
            $password = Hash::make($request->input('password'));
            $array = [
                'user_name' => $request->input('user_name'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role_id' => 2,
                'password' => $password,
            ];

            $authResult = $this->userService->registerUser($array);

            return response()->json($authResult);
        } catch (\Exception $e) {
            return APIResponse::error($e->getMessage());
        }
    }
}
