<?php

namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Values\CategoryData;

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
    public function getAllCategory() : CategoryData
    {
        $categoryData = $this->categoryRepository->getAll();
        return CategoryData::getAllCategory(categories: $categoryData);
    }
}
