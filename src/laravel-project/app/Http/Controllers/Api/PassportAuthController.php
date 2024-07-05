<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\User\User;
use Illuminate\Validation\UnauthorizedException;

class PassportAuthController extends BaseController
{
    /**
     * @OA\Post(
     *      path="api/register",
     *      tags={"Authentication"},
     *      summary="Register a new User",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=201),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="string", example={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9"})
     *         )
     *       )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::query()->create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $user->assignRole($request['role']);

            $token = $user->createToken('LaravelAuthApp')->accessToken;

            $userResource = (new UserResource($user))->toArray($request);

            return $this->sendResponse(array_merge($userResource, ['token' => $token]), 'OK', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
    /**
     * @OA\Post(
     *      path="api/login",
     *      tags={"Authentication"},
     *      summary="Login an existing User",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=200),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="string", example={"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9"})
     *         )
     *       )
     * )
     */
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

            return $this->sendResponse(['token' => $token], 'OK');
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
}
