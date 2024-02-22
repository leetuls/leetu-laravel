<?php

namespace App\Values;

use Illuminate\Contracts\Support\Arrayable;
use App\Values\CategoryData;

final class MenuData implements Arrayable
{
    private function __construct(
        private $menus,
        private $menuModel,
        private $menuCombine
    ) {
    }

    /**
     * get all Data table Menus
     *
     * @param [type] $menus
     * @return MenuData
     */
    public static function getMenus($menus)
    {
        $menuModel = [];
        $menuCombine = ['Không có(danh mục gốc)'];
        $menuCombine = array_column($menus->toArray(), 'name', 'id');
        CategoryData::getModelCategoriesTree(
            $menus,
            $menuModel,
            0,
            array_column(
                $menus->toArray(),
                'parent_id'
            )
        );
        CategoryData::removeKeyCategoriesTree($menuModel);
        array_unshift($menuModel, ['value' => 0, 'label' => 'Danh mục gốc']);
        return new self(
            self::buildTree($menus->toArray()),
            $menuModel,
            $menuCombine
        );
    }

    /**
     * Recursive function to retrieve values of the model menus tree.
     *
     * @param array $elements
     * @param integer $parentId
     * @return void
     */
    public static function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function toArray()
    {
        return [
            'error' => false,
            'menus' => $this->menus,
            'menu_model' => $this->menuModel,
            'menu_combine' => $this->menuCombine
        ];
    }
}
