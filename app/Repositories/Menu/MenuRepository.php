<?php

namespace App\Repositories\Menu;

use App\Repositories\EloquentRepository;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Models\Menu;

class MenuRepository extends EloquentRepository implements MenuRepositoryInterface
{
    public function getModel()
    {
        return Menu::class;
    }
}
