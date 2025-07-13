<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;

class ProductRepository
{
    /**
     * Creates a new product with the provided data.
     *
     * This method attempts to create a new product instance in the database
     * using the provided product data and user ID. If the creation fails,
     * a runtime exception is thrown with the error details.
     *
     * @param  array  $product  The data containing the product attributes (name, description, price).
     * @param  int  $userId  The ID of the user associated with the product.
     * @return Product The newly created product instance.
     *
     * @throws RuntimeException If the product creation fails.
     */
    public function create(array $product, int $userId): Product
    {
        try {
            return Product::create([
                'name' => data_get($product, 'name'),
                'description' => data_get($product, 'description'),
                'price' => (float) data_get($product, 'price'),
                'user_id' => $userId,
            ]);
        } catch (\Exception $e) {
            throw new RuntimeException('Failed to create product: '.$e->getMessage(), 500, $e);
        }
    }

    /**
     * Retrieves a product by its ID.
     *
     * This method fetches a product instance from the database using the
     * provided product ID. If the product does not exist, an exception is thrown.
     *
     * @param  int  $product  The ID of the product to retrieve.
     * @return Product The product instance corresponding to the given ID.
     *
     * @throws ModelNotFoundException If the product is not found.
     */
    public function get(int $product, array $select = ['*']): Product
    {
        return Product::select($select)->findOrFail($product);
    }

    /**
     * Updates the specified product with new data.
     *
     * This method attempts to update the product's attributes (name, description, and price)
     * with the provided data. If any of these fields are present in the data array, they
     * will be updated accordingly. The method also handles exceptions and throws a runtime
     * exception if the update operation fails.
     *
     * @param  Product  $product  The product instance to be updated.
     * @param  array  $data  The data containing the updated fields for the product.
     *
     * @throws RuntimeException If the product update fails.
     */
    public function update(Product $product, array $data): void
    {

        try {
            if (isset($data['name'])) {
                $product->name = data_get($data, 'name');
            }

            if (isset($data['description'])) {
                $product->description = data_get($data, 'description');
            }

            if (isset($data['price'])) {
                $product->price = (float) data_get($data, 'price');
            }

            $product->save();
        } catch (\Exception $e) {
            throw new RuntimeException('Failed to update product: '.$e->getMessage(), 500, $e);
        }
    }

    /**
     * Deletes the specified product.
     *
     * This method attempts to delete the given product instance from the database.
     * If the delete operation fails, a runtime exception is thrown with the error details.
     *
     * @param  Product  $product  The product instance to be deleted.
     *
     * @throws RuntimeException If the product deletion fails.
     */
    public function delete(Product $product): void
    {
        try {
            $product->delete();
        } catch (\Exception $e) {
            throw new RuntimeException('Failed to delete product: '.$e->getMessage(), 500, $e);
        }
    }
}
