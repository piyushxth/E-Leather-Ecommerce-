<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }

    public function index()
    {
        $title = "Settings";
        $setting = Setting::firstOrCreate();
        return view("backend.pages.setting.index", compact("setting","title"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "facebook_link" => "nullable|url|regex:/(facebook)/",
            "instagram_link" => "nullable|url|regex:/(instagram)/",
            "youtube_link" => "nullable|url|regex:/(youtube)/",
            "tiktok_link" => "nullable|url|regex:/(tiktok)/",
        ],[
            "facebook_link.url" => "Facebook link must be url",
            "facebook_link.regex" => "Facebook link is not valid facebook url",
            "instagram_link.url" => "Instagram link must be url",
            "instagram_link.regex" => "Instagram link is not valid instagram url",
            "youtube_link.url" => "Youtube link must be url",
            "youtube_link.regex" => "Youtube link is not valid youtube url",
            "tiktok_link.url" => "Tiktok link must be url",
            "tiktok_link.regex" => "Tiktok link is not valid tiktok url",
        ]);

        $setting = Setting::firstOrCreate();
        $input = $request->all();
                $setting->update($input);

        return redirect()
            ->back()
            ->with("success_msg", "Settings updated successfully");
    }
}