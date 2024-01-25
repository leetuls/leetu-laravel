<?php

namespace App\Values;

use Illuminate\Contracts\Support\Arrayable;

final class CategoryData implements Arrayable
{

    public function __construct(private $categories)
    {
    }

    /**
     * get all Data table Categories
     *
     * @param [type] $categories
     * @return CategoryData
     */
    public static function getAllCategory($categories)
    {
        return new self($categories);
    }

    /**
     * Get the instance as an array.
     *
     * @return array<string, string>
     */
    public function toArray()
    {
        return [
            'error' => false,
            'categories' => $this->categories->toArray()
        ];
    }
}
