<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserResource;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    /**
     * Display a listing of Users.
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(UserResource::collection(User::query()->get()));
    }

    /**
     * Display the specified User.
     */
    public function show(User $user): JsonResponse
    {
        return $this->sendResponse(new UserResource($user));
    }
}
