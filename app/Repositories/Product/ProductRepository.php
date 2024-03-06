<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }

    /**
     * get products data
     *
     */
    public function getProducts()
    {
        return $this->_model::select(
            'products.product_id',
            'products.name',
            'products.price',
            'products.feature_image',
            'products.content',
            'products.branch',
            'categories.name as category_name',
            $this->_model::raw("GROUP_CONCAT(product_images.id,'_',product_images.image SEPARATOR '|') AS detail_images")
        )->join('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('product_images', 'products.product_id', '=', 'product_images.product_id')->groupBy('products.product_id')->orderBy('products.id')->get();
    }
}
