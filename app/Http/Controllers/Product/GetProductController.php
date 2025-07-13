<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $product): JsonResponse
    {
        try {
            $product = $this->service->get($product);

            return response()->json($product);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        } catch (\Exception $e) {
            Log::debug('Error retrieving product', [
                'error' => $e->getMessage(),
                'product_id' => $product,
            ]);

            return response()->json([
                'message' => 'An error occurred while retrieving the product',
            ], 500);
        }
    }
}
