<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }
}
