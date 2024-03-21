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
        $productsData = $this->_prepareProductData($request->products);

        // product_images data
        $productImagesData = $request->product_images;
        $productImagesRemove = $productImagesData['images_remove'];
        $productImagesNew = $productImagesData['images_new'];

        // product_tags data
        $productTagsData = $request->product_tags;
        $productTagsRemove = $productTagsData['tags_remove'];
        $productTagsNew = $productTagsData['tags_new'];
    }

    /**
     * convert base64 data feature_image product to file path
     *
     * @param [type] $productsData
     * @return void
     */
    private function _prepareProductData($productsData)
    {
        $image = explode('base64,', $productsData['feature_image']);
        $image = end($image);
        $image = str_replace(' ', '+', $image);
        $filePath = 'products/' . $productsData['product_id'] . '_feature' . '.jpg';
        Storage::disk('public')->put($filePath, base64_decode($image));
        $productsData['feature_image'] = asset($filePath);
        return $productsData;
    }

    /**
     * convert base64 data product_images to list file path
     *
     * @param [type] $productImagesData
     * @param [type] $productId
     * @return void
     */
    private function _prepareProductImages($productImagesData, $productId)
    {
        $productImagesData = [];
        $productImagesNew = $productImagesData['images_new'];
        foreach ($productImagesNew as $index => $productImage) {
            $image = explode('base64,', $productImage);
            $image = end($image);
            $image = str_replace(' ', '+', $image);
            $filePath = 'products/' . $productId . '_detail' . $index . '.jpg';
            Storage::disk('public')->put($filePath, base64_decode($image));
            $productImagesData[] = ['image' => asset($filePath), 'product_id' => $productId];
        }
        return $productImagesData;
    }
}
