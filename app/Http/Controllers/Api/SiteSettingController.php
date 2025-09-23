<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\Portfolio;
use App\Models\SiteSetting;


class SiteSettingController extends Controller
{
   

    public function index()
    {
        $setting = SiteSetting::first();
        $data = [
            "terms_and_condition"=>$setting->terms_and_condition,
            "start_a_project_url"=>$setting->start_a_project_url,
            "whats_app"=>$setting->whats_app,
            "address"=>$setting->address,
            "telegram"=>$setting->telegram,
            "header_logo"=>asset('/storage/'.$setting->header_logo),
            "favicon"=>asset('/storage/'.$setting->favicon),
            "map"=>$setting->map,
        ];
        return response()->json($data);
    }

    

}
