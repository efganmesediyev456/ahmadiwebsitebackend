<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\MobilProgram;
use App\Models\Partner;
use App\Models\Portfolio;


class PartnerController extends Controller
{
   

    public function index()
    {
        $portfolios = Partner::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id, 
                'url'=>$portfolio->url,
                'floor'=>$portfolio->floor,
                'image'=>url('/storage/'.$portfolio->image)
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }
}
