<?php

namespace App\Services\FrontPage;

use App\Enums\FrontPage\FrontPageSectionStatus;
use App\Filters\FrontPageSection\FrontPageSectionSearchTranslatableFilter;
use App\Models\FrontPage\FrontPageSection;
use App\Models\FrontPage\FrontPageSectionImage;
use App\Services\Upload\UploadService;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FrontPageSectionService{

    private $frontPageSection;

    private $uploadService;
    public function __construct(FrontPageSection $frontPageSection, UploadService $uploadService)
    {
        $this->frontPageSection = $frontPageSection;
        $this->uploadService = $uploadService;
    }

    public function allFrontPageSections(array $filters)
    {
        $frontPageSections = QueryBuilder::for(FrontPageSection::class)
            ->with('translations') // Fetch translations if applicable
            ->allowedFilters([
            ])
            ->where('is_active', true)
            ->where('front_page_id', $filters['frontPageId'])
            ->get();

        return $frontPageSections;

    }

    public function createFrontPageSection(array $frontPageSectionData): FrontPageSection
    {

        $frontPageSection = new FrontPageSection();

        $frontPageSection->name = $frontPageSectionData['name'];
        $frontPageSection->is_active = FrontPageSectionStatus::from($frontPageSectionData['isActive'])->value;
        $frontPageSection->front_page_id = $frontPageSectionData['frontPageId'];
        if(!empty($frontPageSectionData['contentAr'])){
            $frontPageSection->translateOrNew('ar')->content = $frontPageSectionData['contentAr'];
        }

        if(!empty($frontPageSectionData['contentEn'])){
            $frontPageSection->translateOrNew('en')->content = $frontPageSectionData['contentEn'];
        }

        $frontPageSection->save();

        if (!empty($frontPageSectionData['images'])) {
            foreach ($frontPageSectionData['images'] as $image) {
                $path = $this->uploadService->uploadFile($image['path'], 'frontPageSections');

                $frontPageSection = FrontPageSectionImage::create([
                    'front_page_id' => $frontPageSection->id,
                    'path' => $path
                ]);
            }
        }


        return $frontPageSection;

    }

    public function editFrontPageSection(int $frontPageSectionId)
    {
        return FrontPageSection::with('translations', 'images')->find($frontPageSectionId);
    }

    public function updateFrontPageSection(array $frontPageSectionData): FrontPageSection
    {

        $frontPageSection = FrontPageSection::find($frontPageSectionData['frontPageSectionId']);

        $frontPageSection->is_active = FrontPageSectionStatus::from($frontPageSectionData['isActive'])->value;

        if(!empty($frontPageSectionData['contentAr'])){
            $frontPageSection->translateOrNew('ar')->content = $frontPageSectionData['contentAr'];
        }

        if(!empty($frontPageSectionData['contentEn'])){
            $frontPageSection->translateOrNew('en')->content = $frontPageSectionData['contentEn'];
        }

        $frontPageSection->save();

        if (!empty($frontPageSectionData['images'])) {
            foreach ($frontPageSectionData['images'] as $image) {
                $path = $this->uploadService->uploadFile($image['path'], 'frontPageSections');

                $frontPageSectionImage = FrontPageSectionImage::create([
                    'front_page_section_id' => $frontPageSection->id,
                    'path' => $path
                ]);
            }
        }


        return $frontPageSection;

    }


    public function deleteFrontPageSection(int $frontPageSectionId)
    {

        $frontPageSection  = FrontPageSection::find($frontPageSectionId);

        $frontPageSection->delete();

    }

    public function changeStatus(int $frontPageSectionId, bool $isActive)
    {
        $frontPageSection = FrontPageSection::find($frontPageSectionId);
        $frontPageSection->is_active = $isActive;
        $frontPageSection->save();
    }




}
