<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $product): JsonResponse
    {
        try {
            $this->service->delete($product, auth()->user()->id);

            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            return response()->json([
                'message' => 'Unauthorized action',
            ], 403);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product',
            ], 500);
        }
    }
}
