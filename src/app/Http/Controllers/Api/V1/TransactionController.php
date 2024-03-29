<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Individual\Individual;
use App\Models\Transaction\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class TransactionController extends BaseController
{
    public function __construct(private TransactionService $transactionService)
    {}

    /**
     * @OA\Get(
     *     path="api/v1/transactions",
     *     summary="Retrive a listing of the Transactions",
     *     tags={"Transactions"},
     *      @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Transaction")
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
        return $this->sendResponse(TransactionResource::collection(Transaction::query()->get()));
    }

    /**
     * @OA\Get(
     *      path="api/v1/transactions/{uuid}",
     *      tags={"Transactions"},
     *      summary="Get an existing Transaction",
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
     *                  @OA\Items(ref="#/components/schemas/Transaction")
     *              )
     *          )
     *      )
     * )
     *
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return $this->sendResponse(new TransactionResource($transaction));
    }

    /**
     * @OA\Post(
     *      path="api/v1/transactions",
     *      tags={"Transactions"},
     *      summary="Store new Transaction",
     *      @OA\Parameter(name="Authorization", required=true, in="header",
     *          @OA\Schema(type="string", example="Bearer epl5d5olRkge9DK60acfBrrFIHufNeVIXngSWJ7ReCNkr11I6WL")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTransactionRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Transaction")
     *             )
     *         )
     *       )
     * )
     *
     * @param StoreTransactionRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        try {
            $transaction = $this->transactionService->createTransaction($request->validated());

            return $this->sendResponse(new TransactionResource($transaction), '', 201);
        } catch (Exception $exception) {
            return $this->sendResponse([], $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Put(
     *      path="api/v1/transactions/{uuid}",
     *      tags={"Transactions"},
     *      summary="Update an existing Transaction",
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
     *          @OA\JsonContent(ref="#/components/schemas/UpdateTransactionRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", example=0),
     *             @OA\Property(property="message", example=""),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Transaction")
     *             )
     *         )
     *       )
     * )
     *
     * @param UpdateTransactionRequest $request
     * @param Transaction $transaction
     * @return JsonResponse
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        try {
            $transaction = $this->transactionService->updateTransaction($transaction, $request->validated());

            return $this->sendResponse(new TransactionResource($transaction), '', 202);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="api/v1/transactions/{uuid}",
     *      tags={"Transactions"},
     *      summary="Delete existing Transaction",
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
     *                 @OA\Items(ref="#/components/schemas/Transaction")
     *             )
     *         )
     *       )
     * )
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        try {
            $transaction = $this->transactionService->deleteTransaction($transaction);

            return $this->sendResponse(new TransactionResource($transaction), '', 204);
        } catch (Exception $exception) {
            return $this->sendResponse([],  $exception->getMessage(), 500);
        }
    }
}
