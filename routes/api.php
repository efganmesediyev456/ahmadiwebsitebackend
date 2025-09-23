<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CompanyAboutPageController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\MobilProgramController;
use App\Http\Controllers\Api\CompanyAboutController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Api\WorkFlowController;
use App\Http\Controllers\Api\PartnerController;
use App\Http\Controllers\Api\SiteSettingController;

Route::get("/banner", [BannerController::class, 'index']);
Route::get("/banner-details", [BannerController::class, 'bannerDetails']);
Route::get("/portfolios", [PortfolioController::class, 'index']);
Route::get("/mobil-programs", [MobilProgramController::class, 'index']);
Route::get("/company-abouts", [CompanyAboutController::class, 'index']);
Route::get("/work-flows", [WorkFlowController::class, 'index']);
Route::get("/partners", [PartnerController::class, 'index']);
Route::get("/site-settings", [SiteSettingController::class, 'index']);
Route::get('/translations', [TranslationController::class, 'index']);
Route::get('/company-about-page', [CompanyAboutPageController::class, 'index']);
Route::get('/company-team-about', [CompanyAboutPageController::class, 'aboutTeam']);
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/managements', [TeamController::class, 'getManagements']);
Route::get('/our-studio-galleries', [TeamController::class, 'ourStudioGalleries']);
Route::get('/who-we-do-items', [TeamController::class, 'getWhoWeDoItems']);




