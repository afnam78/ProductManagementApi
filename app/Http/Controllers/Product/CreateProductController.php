<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Services\ProductService;
use Illuminate\Support\Facades\Log;

class CreateProductController extends Controller
{
    public function __construct(private readonly ProductService $service)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $userId = auth()->id();

        try {
            $validatedData = $request->validated();

            $product = $this->service->create(
                data: $validatedData,
                userId:  $userId
            );

            return response()->json([
                'message' => 'Product created successfully',
                'product' => $product,
            ], 201);

        } catch (\Exception $exception) {
            Log::debug('Error creating product' , [
                'user_id' => $userId,
                'data' => $request->all(),
                'exception' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Failed to create product',
            ], 500);
        }
    }
}
