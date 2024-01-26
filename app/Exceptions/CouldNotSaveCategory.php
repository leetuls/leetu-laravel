<?php

namespace App\Exceptions;

use Exception;

class CouldNotSaveCategoryException extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not save data table Categories!');
    }
}
