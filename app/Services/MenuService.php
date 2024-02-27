<?php

namespace App\Services;

use Exception;
use App\Exceptions\Menu\CouldNotSaveMenuException;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Values\MenuData;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuService
{
    /**
     * MenuService Contructor
     */
    public function __construct(
        private MenuRepositoryInterface $menuRepository
    ) {
    }

    /**
     * get all Data table menus
     *
     * @return MenuData
     */
    public function getMenus(): MenuData
    {
        $menus = $this->menuRepository->getAll();
        return MenuData::getMenus(menus: $menus);
    }

    /**
     * Create Menu
     *
     * @param [type] $request[name: string, parent_id: int, menu_name: string]
     * @return void
     */
    public function createMenu($request)
    {
        try {
            DB::beginTransaction();
            $menuData = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->menu_name)
            ];
            $this->menuRepository->create($menuData);
            DB::commit();
            $menuOptions = $this->getMenus()->toArray();
            return [
                'error' => false,
                'menus' => $menuOptions['menus'],
                'menus_options' => $menuOptions['menu_model'],
                'menu_combine' => $menuOptions['menu_combine'],
                'message' => 'The menu ' . $menuData['name'] . ' has been added successfully!'
            ];
        } catch (CouldNotSaveMenuException $error) {
            DB::rollBack();
            Log::channel('leetu_shop_history')->error($error);
            throw $error;
        }
    }

    /**
     * Update Menu
     *
     * @param [type] $request[parent_id: int, menu_name: string]
     * @param [type] $id
     * @return void
     */
    public function updateMenu($request, $id)
    {
        try {
            DB::beginTransaction();
            if (!$this->menuRepository->checkExistById($id)) {
                Log::channel('leetu_shop_history')->error('Menu No.' . $id . ' not found!');
                throw new Exception('Menu No.' . $id . ' not found!');
            }

            $menuUpdate = [
                'name' => $request->menu_name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->menu_name)
            ];
            $this->menuRepository->update($id, $menuUpdate);
            $menuOptions = $this->getMenus()->toArray()['menu_model'];
            DB::commit();
            return [
                'error' => false,
                'menu_options' => $menuOptions,
                'message' => 'The menu No.' . $id . ' has been updated successfully!'
            ];
        } catch (CouldNotSaveMenuException $error) {
            DB::rollBack();
            Log::channel('leetu_shop_history')->error($error);
            throw $error;
        }
    }

    /**
     * Delete Menu
     *
     * @param [type] $ids
     * @return void
     */
    public function deleteMenu($ids)
    {
        try {
            DB::beginTransaction();
            $errorIds = $this->_checkExist($ids);
            if (count($errorIds)  > 0) {
                Log::channel('leetu_shop_history')->error('Menu(s) No.' . implode(', ', $errorIds) . ' not found!');
                throw new Exception('The menu(s) No.' . implode(', ', $errorIds) . ' not found!');
            }
            $this->menuRepository->deleteMultiple($ids);
            $menuOptions = $this->getMenus()->toArray();
            DB::commit();
            return [
                'error' => false,
                'menus_options' => $menuOptions['menu_model'],
                'message' => 'The menu(s) No. ' . implode(', ', $ids) . ' has been deleted successfully!'
            ];
        } catch (CouldNotSaveMenuException $error) {
            DB::rollBack();
            Log::channel('leetu_shop_history')->error($error);
            throw $error;
        }
    }

    /**
     * Check exist menu by key
     *
     * @param [type] $ids
     * @return Array
     */
    private function _checkExist($ids)
    {
        $error = [];
        foreach ($ids as $id) {
            if (!$this->menuRepository->checkExistById($id)) {
                $error[] = $id;
            }
        }
        return $error;
    }
}
