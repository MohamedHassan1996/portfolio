<?php

namespace App\Services\Career;

use App\Enums\Career\CareerStatus;
use App\Filters\Career\CareerSearchTranslatableFilter;
use App\Filters\Career\FilterCareer;
use App\Models\Career\Career;
use App\Services\Upload\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class CareerService{

    private $career;
    private $uploadService;
    public function __construct(Career $career, UploadService $uploadService)
    {
        $this->career = $career;
        $this->uploadService = $uploadService;
    }

    public function allCareers()
    {
        $careers = QueryBuilder::for(Career::class)
        ->withTranslation() // Fetch translations if applicable
        ->allowedFilters([
            AllowedFilter::custom('search', new CareerSearchTranslatableFilter()), // Add a custom search filter
        ])
        ->get();
        return $careers;

    }

    public function createCareer(array $careerData): Career
    {


        $career = new Career();

        $career->is_active = CareerStatus::from($careerData['isActive'])->value;


        if (!empty($careerData['titleAr'])) {
            $career->translateOrNew('ar')->title = $careerData['titleAr'];
            $career->translateOrNew('ar')->description = $careerData['descriptionAr'];
            $career->translateOrNew('ar')->content = $careerData['contentAr'];
            $career->translateOrNew('ar')->meta_data = $careerData['metaDataAr'];
            $career->translateOrNew('ar')->extra_details = $careerData['extraDetailsAr'];
            $career->translateOrNew('ar')->slug = $careerData['slugAr'];


        }

        if (!empty($careerData['titleEn'])) {
            $career->translateOrNew('en')->title = $careerData['titleEn'];
            $career->translateOrNew('en')->description = $careerData['descriptionEn'];
            $career->translateOrNew('en')->content = $careerData['contentEn'];
            $career->translateOrNew('en')->meta_data = $careerData['metaDataEn'];
            $career->translateOrNew('en')->extra_details = $careerData['extraDetailsEn'];
            $career->translateOrNew('en')->slug = $careerData['slugEn'];

        }


        $career->save();

        return $career;

    }

    public function editCareer(int $careerId)
    {
        return Career::with('translations')->find($careerId);
    }

    public function updateCareer(array $careerData): Career
    {

        $career = Career::find($careerData['careerId']);

        $career->is_active = CareerStatus::from($careerData['isActive'])->value;


        if (!empty($careerData['titleAr'])) {
            $career->translateOrNew('ar')->title = $careerData['titleAr'];
            $career->translateOrNew('ar')->description = $careerData['descriptionAr'];
            $career->translateOrNew('ar')->content = $careerData['contentAr'];
            $career->translateOrNew('ar')->meta_data = $careerData['metaDataAr'];
            $career->translateOrNew('ar')->extra_details = $careerData['extraDetailsAr'];
            $career->translateOrNew('ar')->slug = $careerData['slugAr'];

        }

        if (!empty($careerData['titleEn'])) {
            $career->translateOrNew('en')->title = $careerData['titleEn'];
            $career->translateOrNew('en')->description = $careerData['descriptionEn'];
            $career->translateOrNew('en')->content = $careerData['contentEn'];
            $career->translateOrNew('en')->meta_data = $careerData['metaDataEn'];
            $career->translateOrNew('en')->extra_details = $careerData['extraDetailsEn'];
            $career->translateOrNew('en')->slug = $careerData['slugEn'];

        }


        $career->save();

        return $career;


    }


    public function deleteCareer(int $careerId)
    {

        $career  = Career::find($careerId);

        $career->delete();

    }


    public function changeStatus(int $careerId, bool $isActive)
    {
        $career = Career::find($careerId);

        $career->is_active = $isActive;
        $career->save();
    }

}
