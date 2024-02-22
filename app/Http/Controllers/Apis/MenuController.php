<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Exceptions\Menu\CouldNotGetMenuException;
use App\Exceptions\Menu\CouldNotSaveMenuException;

class MenuController extends Controller
{
    /**
     * MenuController Contructor
     */
    public function __construct(
        private MenuService $menuService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->menuService->getMenus()->toArray());
        } catch (CouldNotGetMenuException $error) {
            return $this->responseError($error);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            return response()->json(
                $this->menuService->createMenu($request)
            );
        } catch (CouldNotSaveMenuException $error) {
            return $this->responseError($error);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            return response()->json(
                $this->menuService->updateMenu($request, $id)
            );
        } catch (CouldNotSaveMenuException $error) {
            return $this->responseError($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            return response()->json($this->menuService->deleteMenu($request->ids));
        } catch (CouldNotSaveMenuException $error) {
            return $this->responseError($error);
        }
    }
}
