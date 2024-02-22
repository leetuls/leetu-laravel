<?php

namespace App\Exceptions\Category;

use Exception;

class CouldNotGetCategoryException extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not get data table Categories!');
    }
}
