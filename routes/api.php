<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\MobilProgramController;
use App\Http\Controllers\Api\CompanyAboutController;
use App\Http\Controllers\Api\WorkFlowController;
use App\Http\Controllers\Api\PartnerController;

Route::get("/banner", [BannerController::class, 'index']);
Route::get("/banner-details", [BannerController::class, 'bannerDetails']);
Route::get("/portfolios", [PortfolioController::class, 'index']);
Route::get("/mobil-programs", [MobilProgramController::class, 'index']);
Route::get("/company-abouts", [CompanyAboutController::class, 'index']);
Route::get("/work-flows", [WorkFlowController::class, 'index']);
Route::get("/partners", [PartnerController::class, 'index']);


