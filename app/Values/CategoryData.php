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
        $categoryCombine = array_column($categories->toArray(), 'name', 'id');
        array_unshift($categoryCombine, 'Không có(danh mục gốc)');
        self::getModelCategoriesTree(
            $categories,
            $categoryModel,
            0,
            array_column(
                $categories->toArray(),
                'parent_id'
            )
        );
        self::removeKeyCategoriesTree($categoryModel);
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
    private static function getModelCategoriesTree($categories, &$categoryModel = [], $id, $endNote)
    {
        foreach ($categories as $category) {
            if ($category['parent_id'] == $id) {
                $categoryModel[$category['id']] = ['value' => $category['id'], 'label' => $category['name']];
                if (in_array($category['id'], $endNote)) {
                    self::getModelCategoriesTree(
                        $categories,
                        $categoryModel[$category['id']]['children'],
                        $category['id'],
                        $endNote
                    );
                }
            }
        }
    }

    /**
     * Remove key after recursive categories tree
     *
     * @param [type] $categoryModel
     * @return void
     */
    private static function removeKeyCategoriesTree(&$categoryModel)
    {
        $categoryModel = array_merge($categoryModel);
        foreach ($categoryModel as &$model) {
            if (isset($model['children'])) {
                $model = array_merge($model);
                self::removeKeyCategoriesTree($model['children']);
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
