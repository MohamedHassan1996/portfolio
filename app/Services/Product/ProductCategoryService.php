<?php

namespace App\Services\Product;

use App\Enums\Product\ProductCategoryStatus;
use App\Filters\Product\ProductCategorySearchTranslatableFilter;
use App\Models\Product\ProductCategory;
use App\Services\Upload\UploadService;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductCategoryService{

    private $productCategory;
    private $uploadService;
    public function __construct(ProductCategory $productCategory, UploadService $uploadService)
    {
        $this->productCategory = $productCategory;
        $this->uploadService = $uploadService;
    }

    public function allProductCategorys()
    {
        $productCategorys = QueryBuilder::for(ProductCategory::class)
            ->withTranslation() // Fetch translations if applicable
            ->allowedFilters([
                AllowedFilter::custom('search', new ProductCategorySearchTranslatableFilter() ), // Add a custom search filter
            ])->get();

        return $productCategorys;

    }

    public function createProductCategory(array $productCategoryData): ProductCategory
    {

        $productCategory = new ProductCategory();

        $productCategory->is_active = ProductCategoryStatus::from($productCategoryData['isActive'])->value;

        $path = null;

        if (isset($productCategoryData['image'])) {
            $path = $this->uploadService->uploadFile($productCategoryData['image'], 'productCategories');
        }

        if(!empty($productCategoryData['nameAr'])){
            $productCategory->translateOrNew('ar')->name = $productCategoryData['nameAr'];
        }

        if(!empty($productCategoryData['nameEn'])){
            $productCategory->translateOrNew('en')->name = $productCategoryData['nameEn'];
        }

        $productCategory->image = $path;

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

        $path = null;


        if (isset($productCategoryData['image'])) {
            $path = $this->uploadService->uploadFile($productCategoryData['image'], 'productCategories');
        }

        if(!empty($productCategoryData['nameAr'])){
            $productCategory->translateOrNew('ar')->name = $productCategoryData['nameAr'];
        }

        if(!empty($productCategoryData['nameEn'])){
            $productCategory->translateOrNew('en')->name = $productCategoryData['nameEn'];
        }

        if($path){
            Storage::disk('public')->delete($productCategory->image);
            $productCategory->image = $path;
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
