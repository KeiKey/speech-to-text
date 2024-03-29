<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\CompanyResource;
use App\Http\Requests\CompanyRequest;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use App\Services\CompanyService;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyController extends BaseController
{
    public function __construct(private CompanyService $companyService)
    {}

    /**
     * @OA\Get(
     *     path="api/v1/companies",
     *     summary="Retrive a listing of the Companies",
     *     tags={"Companies"},
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
     *                 @OA\Items(ref="#/components/schemas/Company")
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
        return $this->sendResponse(CompanyResource::collection(Company::query()->get()));
    }

    /**
     * @OA\Get(
     *      path="api/v1/companies/{uuid}",
     *      tags={"Companies"},
     *      summary="Get an existing Company",
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
     *                  @OA\Items(ref="#/components/schemas/Company")
     *              )
     *          )
     *      )
     * )
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function show(Company $company): JsonResponse
    {
        return $this->sendResponse(new CompanyResource($company));
    }

    /**
     * @OA\Post(
     *      path="api/v1/companies",
     *      tags={"Companies"},
     *      summary="Store new Company",
     *      @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CompanyRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Company")
     *             )
     *         )
     *       )
     * )
     *
     * @param CompanyRequest $request
     *
     * @return JsonResponse
     */
    public function store(CompanyRequest $request): JsonResponse
    {
        try {
            $company = $this->companyService->createCompany($request->validated());

            return $this->sendResponse(new CompanyResource($company), '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *      path="api/v1/companies/{uuid}",
     *      tags={"Companies"},
     *      summary="Update an existing Company",
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
     *          @OA\JsonContent(ref="#/components/schemas/CompanyRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Company")
     *             )
     *         )
     *       )
     * )
     *
     * @param CompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(CompanyRequest $request, Company $company): JsonResponse
    {
        try {
            $company = $this->companyService->updateCompany($company, $request->validated());

            return $this->sendResponse(new CompanyResource($company), '', 202);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="api/v1/companies/{uuid}",
     *      tags={"Companies"},
     *      summary="Delete existing Company",
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
     *                 @OA\Items(ref="#/components/schemas/Company")
     *             )
     *         )
     *       )
     * )
     */
    public function destroy(Company $company): JsonResponse
    {
        try {
            $company = $this->companyService->deleteCompany($company);

            return $this->sendResponse(new CompanyResource($company), '', 204);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
}
