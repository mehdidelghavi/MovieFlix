<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\Contracts\SettingServiceInterface;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function __construct(private SettingServiceInterface $settingService){}
    public function edit(){
        $settings = $this->settingService->edit();
        return view("Dashboard.Settings.edit", compact('settings'));
    }

    public function update(Request $request){
        $updateSetting = $this->settingService->update($request->except('_token'));
        if ($updateSetting){
            return redirect()->back()->with("success", "تنظیمات با موفقیت ویرایش شدند");
        } else {
            return redirect()->back()->with("failed", "متاسفانه خطایی در ویرایش تنظیمات به وجود آمد");
        }
    }
}
