<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Exceptions\Product\CouldNotGetProductException;
use App\Exceptions\Product\CouldNotSaveProductException;

class ProductController extends Controller
{

    public function __construct(
        private ProductService $productService
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json($this->productService->getProducts()->toArray());
        } catch (CouldNotGetProductException $error) {
            $this->responseError($error);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
