<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

readonly class ProductService
{
    public function __construct(private ProductRepository $repository)
    {
    }

    /**
     * Creates a new product associated with the authenticated user.
     *
     * This method retrieves the authenticated user, associates the product
     * with the user, and creates it using the provided data.
     *
     * @param array $data The data used to create the product. This should include
     *                    all necessary fields required by the Product model.
     * @param int $userId
     * @return Product An array containing a success message and the created product instance.
     */
    public function create(array $data, int $userId): Product
    {
        return $this->repository->create($data, $userId);
    }

    /**
     * Retrieves a product by its ID.
     *
     * This method fetches a product instance from the database using the
     * provided product ID. If the product does not exist, an exception is thrown.
     *
     * @param int $product The ID of the product to retrieve.
     *
     * @return Product The product instance corresponding to the given ID.
     *
     * @throws ModelNotFoundException If the product is not found.
     */
    public function get(int $product, array $select = ['*']): Product
    {
        return $this->repository->get($product, $select);
    }

    /**
     * Updates the specified product with new data provided by the user.
     *
     * This method checks if the authenticated user is authorized to update
     * the specified product. If the user is not authorized, an exception is thrown.
     * The method updates the product's name, description, and price if these fields
     * are present in the provided data.
     *
     * @param int $product
     * @param array $data The data containing the updated fields for the product.
     * @param int $userId The ID of the user attempting to update the product.
     *
     * @return Product
     *
     * @throws AuthenticationException If the user is not authorized to update the product.
     */
    public function update(int $product, array $data, int $userId): Product
    {
        $product = $this->get($product);

        if ($product->user_id !== $userId) {
            throw new AuthenticationException('Unauthorized action');
        }

        $this->repository->update($product, $data);

        return $product;
    }

    /**
     * Deletes a product associated with the given user ID.
     *
     * This method checks if the authenticated user is authorized to delete
     * the specified product. If the user is not authorized, an exception is thrown.
     * If the deletion fails, another exception is thrown.
     *
     * @param int $product The product instance to be deleted.
     * @param int $id The ID of the user attempting to delete the product.
     *
     * @return void
     *
     * @throws AuthenticationException If the user is not authorized to delete the product.
     */
    public function delete(int $product, int $id): void
    {
        $product = $this->get($product, ['id', 'user_id']);

        if ($product->user_id !== $id) {
            throw new AuthenticationException('Unauthorized action');
        }

        $this->repository->delete($product);
    }
}
