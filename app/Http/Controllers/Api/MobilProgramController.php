<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\MobilProgram;
use App\Models\Portfolio;


class MobilProgramController extends Controller
{
   

    public function index()
    {
        $portfolios = MobilProgram::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id,
                'url'=>$portfolio->url,
                'left_or_right'=>$portfolio->left_or_right,
                'image'=>url('/storage/'.$portfolio->image)
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }

    

}
