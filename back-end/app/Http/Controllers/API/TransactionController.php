<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Transaction::with('product', 'cooperative')->paginate(Controller::DEFAULT_PAGE_SIZE),
            200
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request): JsonResponse
    {
        $transaction = Transaction::create($request->validated());

        return response()->json([
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }
}
