<?php

namespace App\Values;

use Illuminate\Contracts\Support\Arrayable;

final class ProductData implements Arrayable
{
    /**
     * Product Data Contructor
     *
     * @param private $products
     */
    public function __construct(private $products)
    {
    }

    /**
     * get data products
     *
     * @param [type] $products
     * @return ProductData
     */
    public static function getProducts($products)
    {
        return new self($products);
    }

    /**
     * function toArray of Arrayble
     *
     * @return void
     */
    public function toArray()
    {
        return [
            'error' => false,
            'products' => $this->products
        ];
    }
}
