<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CooperativeStoreRequest;
use App\Models\Cooperative;
use Illuminate\Http\JsonResponse;

class CooperativeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Cooperative::paginate(Controller::DEFAULT_PAGE_SIZE)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CooperativeStoreRequest $request): JsonResponse
    {
        $cooperative = Cooperative::create($request->validated());

        return response()->json([
            'message' => 'Cooperative created successfully',
            'data' => $cooperative
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(
            Cooperative::findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CooperativeStoreRequest $request, string $id): JsonResponse
    {
        $cooperative = Cooperative::findOrFail($id);
        $cooperative->update($request->validated());

        return response()->json([
            'message' => 'Cooperative updated successfully'
        ]);
    }
}
