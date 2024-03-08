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
            'products.category_id',
            $this->_model::raw("GROUP_CONCAT(DISTINCT(product_images.id), '_', product_images.image SEPARATOR ';') AS detail_images"),
            $this->_model::raw("GROUP_CONCAT(DISTINCT(tags.id), '_', tags.name SEPARATOR ';') AS product_tag"),
        )->leftJoin('product_images', 'products.product_id', '=', 'product_images.product_id')
            ->leftJoin('product_tags', 'products.product_id', '=', 'product_tags.product_id')
            ->leftJoin('tags', 'product_tags.tag_id', '=', 'tags.id')
            ->groupBy('products.product_id')->orderBy('products.id')->get();
    }
}
