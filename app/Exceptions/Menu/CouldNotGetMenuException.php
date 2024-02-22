<?php

namespace App\Exceptions\Menu;

use Exception;

class CouldNotGetMenuException extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not get data table menus!');
    }
}
