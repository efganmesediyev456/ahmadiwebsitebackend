<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;


class BannerController extends Controller
{
   

    public function index()
    {
        $banner = Banner::first();
        return new BannerResource($banner);
    }

    public function bannerDetails(){
        $bannerDetails = BannerDetail::get();

        return $bannerDetails->map(function($item){
            return [
                'id'=>$item->id,
                'title'=>$item->title,
                'url'=>$item->url,
            ];
        });
    }

}
