<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\User\User;
use Illuminate\Validation\UnauthorizedException;

class PassportAuthController extends BaseController
{
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::query()->create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('LaravelAuthApp')->accessToken;

            return $this->sendResponse(['token' => $token], '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = [
                'email'    => $request->email,
                'password' => $request->password
            ];

            if (!auth()->attempt($data)) {
                throw new UnauthorizedException();
            }

            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

            return $this->sendResponse(['token' => $token], '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
}
