<?php

namespace App\Services\Product;

use App\Models\Product\ProductImage;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductImageService{

    private $productImage;
    public function __construct(ProductImage $productImage)
    {
        $this->productImage = $productImage;
    }

    public function allProductImages(array $filters)
    {
        $productImages = QueryBuilder::for(ProductImage::class)
            ->allowedFilters([
                //AllowedFilter::exact('title'), // Add a custom search filter
            ])
            ->where('product_id', $filters['productId'])
            ->get();

        return $productImages;

    }

    public function createProductImage(array $productImageData): ProductImage
    {

        $productImage = new ProductImage();

        $productImage->path = $productImageData['path'];
        $productImage->product_id = $productImageData['productId'];

        $productImage->save();

        return $productImage;

    }

    /*public function editProductImage(int $productImageId)
    {
        return ProductImage::with('translations')->find($productImageId);
    }*/




    public function deleteProductImage(int $productImageId)
    {

        $productImage  = ProductImage::find($productImageId);

        if($productImage->path){
            Storage::disk('public')->delete($productImage->path);
        }

        $productImage->delete();

    }


}
