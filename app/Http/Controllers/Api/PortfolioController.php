<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\Portfolio;


class PortfolioController extends Controller
{
   

    public function index()
    {
        $portfolios = Portfolio::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id,
                'title'=>$portfolio->title,
                'subtitle'=>$portfolio->subtitle,
                'slug'=>$portfolio->slug,
                'image'=>url('/storage/'.$portfolio->image)
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }

    

}
