<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\Portfolio;
use App\Models\WorkFlow;


class WorkFlowController extends Controller
{
    public function index()
    {
        $portfolios = WorkFlow::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id,
                'title'=>$portfolio->title,
                'subtitle'=>$portfolio->subtitle,
                'url'=>$portfolio->url,
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }
}
