<?php

namespace App\Services\MainSetting;

use App\Models\MainSetting\MainSetting;

class MainSettingService{

    private $mainSetting;
    public function __construct(MainSetting $mainSetting)
    {
        $this->mainSetting = $mainSetting;
    }

    public function createMainSetting(array $mainSettingData): MainSetting
    {


        $mainSetting = new MainSetting();

        $mainSetting->content = $mainSettingData['content'];

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

        $mainSetting->save();

        return $mainSetting;


    }


    public function deleteMainSetting(int $mainSettingId)
    {

        return MainSetting::find($mainSettingId)->delete();

    }

}
