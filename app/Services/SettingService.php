<?php

namespace App\Services;

use App\Events\Dashboard\AdminActions;
use App\Models\Setting;
use App\Services\Contracts\SettingServiceInterface;

class SettingService implements SettingServiceInterface{

    public function edit(){
        return Setting::firstOrFail();
    }

    public function update(array $data){
        $settings = $data['group-a'];
        $settingsData = [];
        foreach($settings as $setting){
            $settingsData[$setting['title']] = $setting['value'];
        }
        $updateSetting = Setting::where("id", 1)->update(['options' => $settingsData]);
        event(new AdminActions(['causer' => auth()->user(), 'model' => $updateSetting], 'update', 'setting'));
        return $updateSetting;
    }
}