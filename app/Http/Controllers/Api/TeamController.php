<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\Portfolio;
use App\Models\Team;


class TeamController extends Controller
{
    public function index()
    {
        $portfolios = Team::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id,
                'name'=>$portfolio->name,
                'position'=>$portfolio->position,
                'ln_url'=>$portfolio->ln_url,
                'be_url'=>$portfolio->be_url,
                'image'=>url('/storage/'.$portfolio->image)
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }
}
