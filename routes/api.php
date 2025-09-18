<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\PortfolioController;

Route::get("/banner", [BannerController::class, 'index']);
Route::get("/banner-details", [BannerController::class, 'bannerDetails']);
Route::get("/portfolios", [PortfolioController::class, 'index']);


