<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Response error
     *
     * @param [type] $error
     * @return void
     */
    public function responseError($error)
    {
        return response()->json([
            'error' => true,
            'message' => $error->getMessage()
        ]);
    }
}
