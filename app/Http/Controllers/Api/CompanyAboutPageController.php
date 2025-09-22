<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutTeamContent;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\CompanyAbout;
use App\Models\CompanyAboutPage;
use App\Models\MobilProgram;
use App\Models\Portfolio;


class CompanyAboutPageController extends Controller
{
    public function index()
    {
        $item = CompanyAboutPage::first();
        $data = [
                'id' => $item->id,
                'title' => $item->title,
                'content' => $item->content,
                'content2' => $item->content2,
                'content3' => $item->content3,
                'founded' => $item->founded,
                'team' => $item->team,
            ];
        
        return response()->json($data);
    }

     public function aboutTeam()
    {
        $item = AboutTeamContent::first();
        $data = [
                'id' => $item->id,
                'title' => $item->title,
                'content' => $item->content,
                'content2' => $item->content2,
                'content3' => $item->content3,
            ];
        
        return response()->json($data);
    }
}
