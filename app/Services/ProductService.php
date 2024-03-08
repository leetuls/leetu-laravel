<?php

namespace App\Services;

use Exception;
use App\Exceptions\Product\CouldNotSaveProductException;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Values\ProductData;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Product Service Contructor
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * get products data
     *
     * @return ProductData
     */
    public function getProducts(): ProductData
    {
        $product = $this->productRepository->getProducts();
        return ProductData::getProducts(products: $product);
    }

    public function updateProduct($request, $id)
    {
        // products data
        $productsData = $request->products;
        $featureImages = $productsData['feature_image'];

        // product_images data
        $productImagesData = $request->product_images;
        $productImagesRemove = $productImagesData['images_remove'];
        $productImagesNew = $productImagesData['images_new'];

        // product_tags data
        $productTagsData = $request->product_tags;
        $productTagsRemove = $productTagsData['tags_remove'];
        $productTagsNew = $productTagsData['tags_new'];
    }

    private function _prepareProductData($productsData)
    {
        $featureImages = $productsData['feature_image'];
        foreach ($featureImages as $file) {
            $image = explode('base64,', $file);
            $image = end($image);
            $image = str_replace(' ', '+', $image);
            Storage::disk('public')->put('products/test.jpg', base64_decode($image));
        }
    }
}
