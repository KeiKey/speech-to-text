<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreListingRequest;
use App\Http\Resources\ListingResource;
use App\Models\Listing\Listing;
use App\Services\ListingService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListingController extends BaseController
{
    public function __construct(private ListingService $listingService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(ListingResource::collection(Listing::query()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request): JsonResponse
    {
        try {
            $listing = $this->listingService->createListing($request->validated(), $request->user());

            return $this->sendResponse(new ListingResource($listing), '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified Listing.
     */
    public function show(Listing $listing): JsonResponse
    {
        return $this->sendResponse(new ListingResource($listing));
    }

    /**
     * Update the specified Listing in storage.
     */
    public function update(Request $request, Listing $listing): JsonResponse
    {
        return $this->sendResponse(new ListingResource($listing), '', 201);
    }

    /**
     * Remove the specified Listing from storage.
     */
    public function destroy(Listing $listing): JsonResponse
    {
        return $this->sendResponse(new ListingResource($listing), '', 201);
    }
}
