<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\Management;
use App\Models\OurStudioGallery;
use App\Models\Portfolio;
use App\Models\Team;
use App\Models\WhoWeDo;


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

    public function getManagements(){
        $portfolios = Management::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id,
                'name'=>$portfolio->name,
                'position'=>$portfolio->position,
                'ln_url'=>$portfolio->ln_url,
                'be_url'=>$portfolio->be_url,
                'description'=>$portfolio->description,
                'image'=>url('/storage/'.$portfolio->image)
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }


    public function ourStudioGalleries(){
        $portfolios = OurStudioGallery::get();
        $data = $portfolios->map(function($portfolio){
            return [
                'id'=>$portfolio->id,
                'image'=>url('/storage/'.$portfolio->image)
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }


    public function getWhoWeDoItems(){
        $portfolios = WhoWeDo::get();
        $data = $portfolios->map(function($portfolio){

            $items = $portfolio->items?->map(function($it){
                return [
                    "id"=>$it->id,
                    "title"=>$it->title,
                    "description"=>$it->description
                ];
            });
            return [
                'id'=>$portfolio->id,
                'title'=>$portfolio->title,
                'description'=>$portfolio->description,
                'items'=>$items
            ];
        });
        return response()->json([
            "data"=>$data
        ]);
    }
}
