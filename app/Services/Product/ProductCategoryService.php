<?php

namespace App\Services\Product;

use App\Enums\Product\ProductCategoryStatus;
use App\Models\Product\ProductCategory;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductCategoryService{

    private $productCategory;
    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function allProductCategorys()
    {
        $productCategorys = QueryBuilder::for(ProductCategory::class)
            ->withTranslation() // Fetch translations if applicable
            ->allowedFilters([
                //AllowedFilter::exact('title'), // Add a custom search filter
            ])->get();

        return $productCategorys;

    }

    public function createProductCategory(array $productCategoryData): ProductCategory
    {

        $productCategory = new ProductCategory();

        $productCategory->is_active = ProductCategoryStatus::from($productCategoryData['isActive'])->value;

        if(!empty($productCategoryData['nameAr'])){
            $productCategory->translateOrNew('ar')->name = $productCategoryData['nameAr'];
        }

        if(!empty($productCategoryData['nameEn'])){
            $productCategory->translateOrNew('en')->name = $productCategoryData['nameEn'];
        }

        $productCategory->save();

        return $productCategory;

    }

    public function editProductCategory(int $productCategoryId)
    {
        return ProductCategory::with('translations')->find($productCategoryId);
    }

    public function updateProductCategory(array $productCategoryData): ProductCategory
    {

        $productCategory = ProductCategory::find($productCategoryData['productCategoryId']);

        $productCategory->is_active = ProductCategoryStatus::from($productCategoryData['isActive'])->value;

        if(!empty($productCategoryData['nameAr'])){
            $productCategory->translateOrNew('ar')->name = $productCategoryData['nameAr'];
        }

        if(!empty($productCategoryData['nameEn'])){
            $productCategory->translateOrNew('en')->name = $productCategoryData['nameEn'];
        }

        $productCategory->save();

        return $productCategory;


    }


    public function deleteProductCategory(int $productCategoryId)
    {

        $productCategory  = ProductCategory::find($productCategoryId);

        $productCategory->delete();

    }

    public function changeStatus(int $productCategoryId, bool $isActive)
    {
        $productCategory = ProductCategory::find($productCategoryId);
        $productCategory->is_active = $isActive;
        $productCategory->save();
    }

}
