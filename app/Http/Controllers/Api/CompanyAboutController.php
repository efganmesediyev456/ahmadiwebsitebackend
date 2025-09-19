<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerDetail;
use App\Http\Resources\BannerResource;
use App\Models\CompanyAbout;
use App\Models\MobilProgram;
use App\Models\Portfolio;


class CompanyAboutController extends Controller
{
    public function index()
    {
        $portfolios = CompanyAbout::get();
        $data = $portfolios->map(function ($portfolio) {
            return [
                'id' => $portfolio->id,
                'url' => $portfolio->url,
                'title' => $portfolio->title,
                'subtitle' => $portfolio->subtitle,
            ];
        });
        return response()->json([
            "data" => $data
        ]);
    }
}
