<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreateListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Http\Resources\ListingResource;
use App\Models\Listing\Listing;
use App\Services\ListingService;
use Illuminate\Http\JsonResponse;
use Exception;

class ListingController extends BaseController
{
    public function __construct(private readonly ListingService $listingService)
    {}

    /**
     * @OA\Get(
     *     path="api/v1/listings",
     *     summary="Retrive a listing of the Listings",
     *     tags={"Listings"},
     *     @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Listings")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(ListingResource::collection(Listing::query()->get()));
    }

    /**
     * @OA\Get(
     *      path="api/v1/listings/{uuid}",
     *      tags={"Listings"},
     *      summary="Get an existing Listings",
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
     *                  @OA\Items(ref="#/components/schemas/Listings")
     *              )
     *          )
     *      )
     * )
     */
    public function show(Listing $listing): JsonResponse
    {
        return $this->sendResponse(new ListingResource($listing));
    }

    /**
     * @OA\Post(
     *      path="api/v1/listings",
     *      tags={"Listings"},
     *      summary="Store new Listings",
     *      @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateListingRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Listings")
     *             )
     *         )
     *       )
     * )
     */
    public function store(CreateListingRequest $request): JsonResponse
    {
        try {
            $listing = $this->listingService->createListing($request->validated(), $request->user());

            return $this->sendResponse(new ListingResource($listing), '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *      path="api/v1/listings/{uuid}",
     *      tags={"Listings"},
     *      summary="Update an existing Listings",
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
     *          @OA\JsonContent(ref="#/components/schemas/UpdateListingRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Listings")
     *             )
     *         )
     *       )
     * )
     */
    public function update(UpdateListingRequest $request, Listing $listing): JsonResponse
    {
        try {
            $listing = $this->listingService->updateListing($listing, $request->validated());

            return $this->sendResponse(new ListingResource($listing), '', 202);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="api/v1/listings/{uuid}",
     *      tags={"Listings"},
     *      summary="Delete existing Listings",
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
     *                 @OA\Items(ref="#/components/schemas/Listings")
     *             )
     *         )
     *       )
     * )
     */
    public function destroy(Listing $listing): JsonResponse
    {
        try {
            $this->listingService->deleteListing($listing);

            return $this->sendResponse('', '', 204);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
}
