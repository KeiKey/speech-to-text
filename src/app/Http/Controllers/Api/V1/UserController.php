<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserResource;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    /**
     * @OA\Get(
     *     path="api/v1/users",
     *     summary="Retrive a listing of the Users",
     *     tags={"Users"},
     *     @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=200),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Users")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(UserResource::collection(User::query()->get()));
    }

    /**
     * @OA\Get(
     *      path="api/v1/users/{uuid}",
     *      tags={"Users"},
     *      summary="Get an existing Users",
     *      @OA\Parameter(
     *          name="uuid",
     *          description="Individual uuid",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              example="389ffffe-b89c-47b6-bc63-cf5fd2a88218"
     *          )
     *      ),
     *      @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              @OA\Property(property="code", example=200),
     *              @OA\Property(property="message", example=""),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(ref="#/components/schemas/Users")
     *              )
     *          )
     *      )
     * )
     */
    public function show(User $user): JsonResponse
    {
        return $this->sendResponse(new UserResource($user));
    }
}
