<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Exceptions\CouldNotGetCategoryException;
use App\Exceptions\CouldNotSaveCategoryException;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(
        CategoryService $categoryService
    ) {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->categoryService->getAllCategory()->toArray());
        } catch (CouldNotGetCategoryException $error) {
            return response()->json([
                'error' => true,
                'message' => $error->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            return response()->json(
                $this->categoryService->createCategory($request)
            );
        } catch (CouldNotSaveCategoryException $error) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $error->getMessage()
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            return response()->json(
                $this->categoryService->updateCategory($request, $id)
            );
        } catch (CouldNotSaveCategoryException $error) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $error->getMessage()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return response()->json(
                $this->categoryService->deleteCategory($id)
            );
        } catch (CouldNotSaveCategoryException $error) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $error->getMessage()
                ]
            );
        }
    }

    /**
     * Category View Model
     *
     * @return void
     */
    public function viewModel()
    {
        try {
            return response()->json($this->categoryService->getCategoryViewModel());
        } catch (CouldNotGetCategoryException $error) {
            return response()->json([
                'error' => true,
                'message' => $error->getMessage()
            ]);
        }
    }
}
