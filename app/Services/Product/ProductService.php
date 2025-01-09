<?php

namespace App\Services\Product;

use App\Enums\Product\ProductStatus;
use App\Filters\Product\ProductSearchTranslatableFilter;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductService{

    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function allProducts()
    {
        $products = QueryBuilder::for(Product::class)
            ->withTranslation() // Fetch translations if applicable
            ->allowedFilters([
                AllowedFilter::custom('search', new ProductSearchTranslatableFilter()), // Add a custom search filter
            ])
            ->with('images')
            ->get();

        return $products;

    }

    public function createProduct(array $productData): Product
    {

        $product = new Product();

        $product->is_active = ProductStatus::from($productData['isActive'])->value;

        if(!empty($productData['nameAr'])){
            $product->translateOrNew('ar')->name = $productData['nameAr'];
            $product->translateOrNew('ar')->description = $productData['descriptionAr'];
            $product->translateOrNew('ar')->content = $productData['contentAr'];
            $product->translateOrNew('ar')->slug = $productData['slugAr'];
            $product->translateOrNew('ar')->meta_data = $productData['metaDataAr'];

        }

        if(!empty($productData['nameEn'])){
            $product->translateOrNew('en')->name = $productData['nameEn'];
            $product->translateOrNew('en')->description = $productData['descriptionEn'];
            $product->translateOrNew('en')->content = $productData['contentEn'];
            $product->translateOrNew('en')->slug = $productData['slugEn'];
            $product->translateOrNew('en')->meta_data = $productData['metaDataEn'];
        }

        $product->save();

        return $product;

    }

    public function editProduct(int $productId)
    {
        return Product::with('translations', 'images')->find($productId);
    }

    public function updateProduct(array $productData): Product
    {

        $product = Product::find($productData['productId']);

        $product->is_active = ProductStatus::from($productData['isActive'])->value;

        if(!empty($productData['nameAr'])){
            $product->translateOrNew('ar')->name = $productData['nameAr'];
            $product->translateOrNew('ar')->description = $productData['descriptionAr'];
            $product->translateOrNew('ar')->content = $productData['contentAr'];
            $product->translateOrNew('ar')->slug = $productData['slugAr'];
            $product->translateOrNew('ar')->meta_data = $productData['metaDataAr'];

        }

        if(!empty($productData['nameEn'])){
            $product->translateOrNew('en')->name = $productData['nameEn'];
            $product->translateOrNew('en')->description = $productData['descriptionEn'];
            $product->translateOrNew('en')->content = $productData['contentEn'];
            $product->translateOrNew('en')->slug = $productData['slugEn'];
            $product->translateOrNew('en')->meta_data = $productData['metaDataEn'];
        }

        $product->save();

        return $product;


    }


    public function deleteProduct(int $productId)
    {

        $product  = Product::find($productId);

        $product->delete();

    }

    public function changeStatus(int $productId, bool $isActive)
    {
        $product = Product::find($productId);
        $product->is_active = $isActive;
        $product->save();
    }

}
