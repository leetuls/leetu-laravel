<?php

namespace App\Exceptions\Product;

use Exception;

class CouldNotGetProductException extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not get data table Products!');
    }
}
