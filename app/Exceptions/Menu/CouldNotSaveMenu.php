<?php

namespace App\Exceptions\Menu;

use Exception;

class CouldNotSaveMenuException extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not save data table menus!');
    }
}
