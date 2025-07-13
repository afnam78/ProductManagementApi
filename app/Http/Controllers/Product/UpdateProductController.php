<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateProductRequest $request, int $product): \Illuminate\Http\JsonResponse
    {
        try {
            $validated = $request->validated();

            $product = $this->service->update(product: $product, data: $validated, userId: auth()->id());

            return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Product not found'], 404);
        } catch (\Illuminate\Auth\AuthenticationException $exception) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'An error occurred while updating the product'], 500);
        }
    }
}
