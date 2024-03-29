<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\IndividualRequest;
use App\Http\Resources\IndividualResource;
use App\Models\Individual\Individual;
use App\Services\IndividualService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndividualController extends BaseController
{
    public function __construct(private IndividualService $individualService)
    {}

    /**
     * @OA\Get(
     *     path="api/v1/individuals",
     *     summary="Retrive a listing of the Individuals",
     *     tags={"Individuals"},
     *     @OA\Parameter(name="Authorization", required=true, in="header",
     *         @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Individual")
     *             )
     *         )
     *     )
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(IndividualResource::collection(Individual::query()->get()));
    }

    /**
     * @OA\Get(
     *      path="api/v1/individuals/{uuid}",
     *      tags={"Individuals"},
     *      summary="Get an existing Individual",
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
     *              @OA\Property(property="code", example=0),
     *              @OA\Property(property="message", example=""),
     *              @OA\Property(property="data", type="array",
     *                  @OA\Items(ref="#/components/schemas/Individual")
     *              )
     *          )
     *      )
     * )
     *
     * @param Individual $individual
     * @return JsonResponse
     */
    public function show(Individual $individual): JsonResponse
    {
        return $this->sendResponse(new IndividualResource($individual));
    }

    /**
     * @OA\Post(
     *      path="api/v1/individuals",
     *      tags={"Individuals"},
     *      summary="Store new Individual",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/IndividualRequest")
     *      ),
     *      @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Individual")
     *             )
     *         )
     *       )
     * )
     *
     * @param IndividualRequest $request
     *
     * @return JsonResponse
     */
    public function store(IndividualRequest $request): JsonResponse
    {
        try {
            $individual = $this->individualService->createIndividual($request->validated());

            return $this->sendResponse(new IndividualResource($individual), '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *      path="api/v1/individuals/{uuid}",
     *      tags={"Individuals"},
     *      summary="Update an existing Individual",
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/IndividualRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Individual")
     *             )
     *         )
     *       )
     * )
     *
     * @param IndividualRequest $request
     * @param Individual $individual
     * @return JsonResponse
     */
    public function update(IndividualRequest $request, Individual $individual): JsonResponse
    {
        try {
            $individual = $this->individualService->updateIndividual($individual, $request->validated());

            return $this->sendResponse(new IndividualResource($individual), '', 202);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="api/v1/individuals/{uuid}",
     *      tags={"Individuals"},
     *      summary="Delete existing Individual",
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
     *          response=204,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Individual")
     *             )
     *         )
     *       )
     * )
     */
    public function destroy(Individual $individual): JsonResponse
    {
        try {
            $individual = $this->individualService->deleteIndividual($individual);

            return $this->sendResponse(new IndividualResource($individual), '', 204);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
}
