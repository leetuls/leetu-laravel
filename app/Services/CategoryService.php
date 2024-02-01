<?php

namespace App\Services;

use App\Exceptions\CouldNotSaveCategoryException;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Values\CategoryData;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * get all Data table Categories
     *
     * @return CategoryData
     */
    public function getAllCategory(): CategoryData
    {
        $categoryData = $this->categoryRepository->getAll();
        return CategoryData::getAllCategory(categories: $categoryData);
    }

    /**
     * Create Category
     *
     * @param [type] $request
     * @return void
     */
    public function createCategory($request)
    {
        try {
            DB::beginTransaction();
            $categoryData = [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->category_name)
            ];

            $this->categoryRepository->create($categoryData);
            $categoryOptions = $this->getAllCategory()->toArray();
            DB::commit();
            return [
                'error' => false,
                'categories' => $categoryOptions['categories'],
                'categories_options' => $categoryOptions['category_model'],
                'category_combine' => $categoryOptions['category_combine'],
                'message' => 'The category ' . $categoryData['name'] . ' has been added successfully!'
            ];
        } catch (CouldNotSaveCategoryException $error) {
            DB::rollBack();
            throw $error;
        }
    }

    /**
     * Update Category
     *
     * @param [type] $request
     * @return void
     */
    public function updateCategory($request, $id)
    {
        try {
            DB::beginTransaction();
            if (!$this->categoryRepository->checkExistById($id)) {
                throw new Exception('Category No.' . $id . ' not found!');
            }

            $categoryUpdate = [
                'name' => $request->category_name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->category_name)
            ];
            $this->categoryRepository->update($id, $categoryUpdate);
            $categoryOptions = $this->getAllCategory()->toArray()['category_model'];
            DB::commit();
            return [
                'error' => false,
                'categories_options' => $categoryOptions,
                'message' => 'The category No.' . $id . ' has been updated successfully!'
            ];
        } catch (CouldNotSaveCategoryException $error) {
            DB::rollBack();
            throw $error;
        }
    }

    /**
     * Delete Category
     *
     * @param [type] $id
     * @return void
     */
    public function deleteCategory($id)
    {
        try {
            DB::beginTransaction();
            if (!$this->categoryRepository->checkExistById($id)) {
                throw new Exception('Category No.' . $id . ' not found!');
            }
            $this->categoryRepository->delete($id);
            DB::commit();
            return [
                'error' => false,
                'message' => 'The category No.' . $id . ' has been deleted successfully!'
            ];
        } catch (CouldNotSaveCategoryException $error) {
            DB::rollBack();
            throw $error;
        }
    }
}
