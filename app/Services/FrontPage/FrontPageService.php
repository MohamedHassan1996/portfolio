<?php

namespace App\Services\FrontPage;

use App\Enums\FrontPage\FrontPageStatus;
use App\Filters\FrontPage\FrontPageSearchTranslatableFilter;
use App\Models\FrontPage\FrontPage;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FrontPageService{

    private $frontPage;
    public function __construct(FrontPage $frontPage)
    {
        $this->frontPage = $frontPage;
    }

    public function allFrontPages()
    {
        $frontPages = QueryBuilder::for(FrontPage::class)
            ->withTranslation() // Fetch translations if applicable
            ->allowedFilters([
                AllowedFilter::custom('search', new FrontPageSearchTranslatableFilter() ), // Add a custom search filter
            ])->get();

        return $frontPages;

    }

    public function createFrontPage(array $frontPageData): FrontPage
    {

        $frontPage = new FrontPage();

        $frontPage->is_active = FrontPageStatus::from($frontPageData['isActive'])->value;

        if(!empty($frontPageData['titleAr'])){
            $frontPage->translateOrNew('ar')->title = $frontPageData['titleAr'];
            $frontPage->translateOrNew('ar')->slug = $frontPageData['slugAr'];
            $frontPage->translateOrNew('ar')->meta_data = $frontPageData['metaDataAr'];
        }

        if(!empty($frontPageData['titleEn'])){
            $frontPage->translateOrNew('en')->title = $frontPageData['titleEn'];
            $frontPage->translateOrNew('en')->slug = $frontPageData['slugEn'];
            $frontPage->translateOrNew('en')->meta_data = $frontPageData['metaDataEn'];
        }

        $frontPage->save();

        return $frontPage;

    }

    public function editFrontPage(int $frontPageId)
    {
        return FrontPage::with('translations')->find($frontPageId);
    }

    public function updateFrontPage(array $frontPageData): FrontPage
    {

        $frontPage = FrontPage::find($frontPageData['frontPageId']);

        $frontPage->is_active = FrontPageStatus::from($frontPageData['isActive'])->value;

        if(!empty($frontPageData['titleAr'])){
            $frontPage->translateOrNew('ar')->title = $frontPageData['titleAr'];
            $frontPage->translateOrNew('ar')->slug = $frontPageData['slugAr'];
            $frontPage->translateOrNew('ar')->meta_data = $frontPageData['metaDataAr'];
        }

        if(!empty($frontPageData['titleEn'])){
            $frontPage->translateOrNew('en')->title = $frontPageData['titleEn'];
            $frontPage->translateOrNew('en')->slug = $frontPageData['slugEn'];
            $frontPage->translateOrNew('en')->meta_data = $frontPageData['metaDataEn'];
        }

        $frontPage->save();

        return $frontPage;

    }


    public function deleteFrontPage(int $frontPageId)
    {

        $frontPage  = FrontPage::find($frontPageId);

        $frontPage->delete();

    }

    public function changeStatus(int $frontPageId, bool $isActive)
    {
        $frontPage = FrontPage::find($frontPageId);
        $frontPage->is_active = $isActive;
        $frontPage->save();
    }




}
