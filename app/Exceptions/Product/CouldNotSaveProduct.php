<?php

namespace App\Exceptions\Product;

use Exception;

class CouldNotSaveProductException extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not save data table Products!');
    }
}
