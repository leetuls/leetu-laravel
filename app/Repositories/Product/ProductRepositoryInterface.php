<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepositoryInterface;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * get products data
     *
     */
    public function getProducts();
}
