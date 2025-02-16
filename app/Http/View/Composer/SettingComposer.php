<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Models\Setting;



class SettingComposer
{
    public function compose(View $view)
    {
        $setting= Setting::firstOrCreate();
       
        $view->with('setting_com', $setting);
    }
}
