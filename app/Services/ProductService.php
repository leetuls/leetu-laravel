<?php

namespace App\Services;

use Exception;
use App\Exceptions\Product\CouldNotSaveProductException;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Values\ProductData;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * Product Service Contructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * get products data
     *
     * @return ProductData
     */
    public function getProducts(): ProductData
    {
        $product = $this->productRepository->getProducts();
        return ProductData::getProducts(products: $product);
    }
}
