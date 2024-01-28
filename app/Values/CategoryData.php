<?php

namespace App\Values;

use Illuminate\Contracts\Support\Arrayable;

final class CategoryData implements Arrayable
{

    public function __construct(
        private $categories,
        private $categoryModel,
        private $categoryCombine
    ) {
    }

    /**
     * get all Data table Categories
     *
     * @param [type] $categories
     * @return CategoryData
     */
    public static function getAllCategory($categories)
    {
        $categoryModel = [];
        $categoryCombine = ['Không có(danh mục gốc)'];
        foreach ($categories as $category) {
            $categoryCombine[$category['id']] = $category['name'];
            if ($category['parent_id'] === 0) {
                $categoryModel[] = ['value' => $category['id'], 'label' => $category['name']];
            } else {
                self::getModelCategoriesTree($categoryModel, $category);
            }
        }
        array_unshift($categoryModel, ['value' => 0, 'label' => 'Danh mục gốc']);
        return new self($categories, $categoryModel, $categoryCombine);
    }

    /**
     * Recursive function to retrieve values of the model categories tree.
     *
     * @param [type] $categoryModel
     * @param [type] $category
     * @return void
     */
    private static function getModelCategoriesTree(&$categoryModel, $category)
    {
        foreach($categoryModel as &$model) {
            if ($model['value'] == $category['parent_id']) {
                $model['children'][] = ['value' => $category['id'], 'label' => $category['name']];
            } else {
                if (isset($model['children'])) {
                    self::getModelCategoriesTree($model['children'], $category);
                }
            }
        }
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
            'categories' => $this->categories->toArray(),
            'category_model' => $this->categoryModel,
            'category_combine' => $this->categoryCombine
        ];
    }
}
