<?php

namespace App\Services\MainSetting;

use App\Models\MainSetting\MainSetting;
use App\Services\Upload\UploadService;
use Illuminate\Http\UploadedFile;

class MainSettingService{

    private $mainSetting;
    private $uploadService;
    public function __construct(MainSetting $mainSetting, UploadService $uploadService)
    {
        $this->mainSetting = $mainSetting;
        $this->uploadService = $uploadService;
    }

    public function createMainSetting(array $mainSettingData): MainSetting
    {


        $mainSetting = new MainSetting();

        $mainSetting->content = $mainSettingData['content'];



        $logo = null;
        $favicon = null;

        if(isset($mainSettingData['logo'])){
            $logo =  $this->uploadService->uploadFile($mainSettingData['logo'], 'main_settings');
        }

        if(isset($mainSettingData['favicon'])){
            $favicon =  $this->uploadService->uploadFile($mainSettingData['favicon'], 'main_settings');
        }

        $mainSetting->logo = $logo;
        $mainSetting->favicon = $favicon;


        $mainSetting->save();


        return $mainSetting;



    }

    public function editMainSetting(int $mainSettingId)
    {
        return MainSetting::find($mainSettingId);
    }

    public function updateMainSetting(array $mainSettingData): MainSetting
    {

        $mainSetting = MainSetting::find($mainSettingData['mainSettingId']);

        $mainSetting->content = $mainSettingData['content'];

        $logo = null;
        $favicon = null;

        if(isset($mainSettingData['favicon']) && $mainSettingData['favicon'] instanceof UploadedFile){
            $favicon =  $this->uploadService->uploadFile($mainSettingData['favicon'], 'main_settings');
            $mainSetting->favicon = $favicon;
        }

        if(isset($mainSettingData['logo']) && $mainSettingData['logo'] instanceof UploadedFile){
            $logo =  $this->uploadService->uploadFile($mainSettingData['logo'], 'main_settings');
            $mainSetting->logo = $logo;
        }

        $mainSetting->save();

        return $mainSetting;


    }


    public function deleteMainSetting(int $mainSettingId)
    {

        return MainSetting::find($mainSettingId)->delete();

    }

}
