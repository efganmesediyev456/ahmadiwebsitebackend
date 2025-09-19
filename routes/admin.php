<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\CompanyAboutController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MobilProgramController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\Regulations\LanguageController;
use App\Http\Controllers\Backend\Regulations\TranslationController;
use App\Http\Controllers\Backend\ServiceCategoryController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\WorkFlowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Settings\SiteSettingController;
use App\Http\Controllers\Backend\GeneralController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BannerDetailController;





Route::get("/login", [LoginController::class, 'login'])->name('.login');
Route::post("/login", [LoginController::class, 'loginPost'])->name('.login.post');
Route::post("/logout", [LoginController::class, 'logout'])->name('.logout');

Route::middleware("auth:admin")->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('.dashboard');

    Route::group(['prefix' => 'languages', 'as' => '.languages'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('.index');
        Route::get('/create', [LanguageController::class, 'create'])->name('.create');
        Route::post('/store', [LanguageController::class, 'store'])->name('.store');
        Route::get('/{item}/edit', [LanguageController::class, 'edit'])->name('.edit');
        Route::put('/{item}/update', [LanguageController::class, 'update'])->name('.update');
        Route::delete('/{item}', [LanguageController::class, 'delete'])->name('.destroy');
    });



    Route::group(['prefix' => 'translations', 'as' => '.translations'], function () {
        Route::get('/', [TranslationController::class, 'index'])->name('.index');
        Route::get('/create', [TranslationController::class, 'create'])->name('.create');
        Route::post('/store', [TranslationController::class, 'store'])->name('.store');
        Route::get('/{item}/edit', [TranslationController::class, 'edit'])->name('.edit');
        Route::put('/{item}/update', [TranslationController::class, 'update'])->name('.update');
        Route::delete('/{item}', [TranslationController::class, 'delete'])->name('.destroy');
    });






    Route::group(['prefix' => 'settings', 'as' => '.settings'], function () {
        Route::get('/', [SiteSettingController::class, 'index'])->name('.index');
        Route::put('/{item}/update', [SiteSettingController::class, 'update'])->name('.update');
    });

    Route::post('/update-status', [GeneralController::class, 'updateStatus'])->name('.update-status');
    Route::post('/all/update-order', [GeneralController::class, 'updateOrder'])->name('.all.update-order');


    Route::group(['prefix' => 'banner', 'as' => '.banner'], function () {
        Route::get('/', [BannerController::class, 'index'])->name('.index');
        Route::put('/{item}/update', [BannerController::class, 'update'])->name('.update');
    });




    Route::group(['prefix' => 'banner-details', 'as' => '.banner-details'], function () {
        Route::get('/', [BannerDetailController::class, 'index'])->name('.index');
        Route::get('/create', [BannerDetailController::class, 'create'])->name('.create');
        Route::post('/', [BannerDetailController::class, 'store'])->name('.store');
        Route::get('/{banner}', [BannerDetailController::class, 'show'])->name('.show');
        Route::get('/{banner}/edit', [BannerDetailController::class, 'edit'])->name('.edit');
        Route::put('/{banner}', [BannerDetailController::class, 'update'])->name('.update');
        Route::delete('/{banner}', [BannerDetailController::class, 'destroy'])->name('.destroy');
    });


    Route::group(['prefix' => 'portfolios', 'as' => '.portfolios'], function () {
        Route::get('/', [PortfolioController::class, 'index'])->name('.index');
        Route::get('/create', [PortfolioController::class, 'create'])->name('.create');
        Route::post('/', [PortfolioController::class, 'store'])->name('.store');
        Route::get('/{portfolio}', [PortfolioController::class, 'show'])->name('.show');
        Route::get('/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('.edit');
        Route::put('/{portfolio}', [PortfolioController::class, 'update'])->name('.update');
        Route::delete('/{portfolio}', [PortfolioController::class, 'destroy'])->name('.destroy');
    });

    Route::group(['prefix' => 'service-category', 'as' => '.service-category'], function () {
        Route::get('/', [ServiceCategoryController::class, 'index'])->name('.index');
        Route::get('/create', [ServiceCategoryController::class, 'create'])->name('.create');
        Route::post('/', [ServiceCategoryController::class, 'store'])->name('.store');
        Route::get('/{serviceCategory}/edit', [ServiceCategoryController::class, 'edit'])->name('.edit');
        Route::put('/{serviceCategory}', [ServiceCategoryController::class, 'update'])->name('.update');
        Route::delete('/{serviceCategory}', [ServiceCategoryController::class, 'destroy'])->name('.destroy');
    });

    Route::group(['prefix' => 'service', 'as' => '.service'], function () {
        Route::get('/', [ServiceController::class, 'index'])->name('.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('.create');
        Route::post('/', [ServiceController::class, 'store'])->name('.store');
        Route::get('/{serviceCategory}/edit', [ServiceController::class, 'edit'])->name('.edit');
        Route::put('/{serviceCategory}', [ServiceController::class, 'update'])->name('.update');
        Route::delete('/{serviceCategory}', [ServiceController::class, 'destroy'])->name('.destroy');
    });


    Route::group(['prefix' => 'mobil-programs', 'as' => '.mobil_programs'], function () {
        Route::get('/', [MobilProgramController::class, 'index'])->name('.index');
        Route::get('/create', [MobilProgramController::class, 'create'])->name('.create');
        Route::post('/', [MobilProgramController::class, 'store'])->name('.store');
        Route::get('/{mobilProgram}', [MobilProgramController::class, 'show'])->name('.show');
        Route::get('/{mobilProgram}/edit', [MobilProgramController::class, 'edit'])->name('.edit');
        Route::put('/{mobilProgram}', [MobilProgramController::class, 'update'])->name('.update');
        Route::delete('/{mobilProgram}', [MobilProgramController::class, 'destroy'])->name('.destroy');
    });

    Route::group(['prefix' => 'company-abouts', 'as' => '.company_abouts'], function () {
        Route::get('/', [CompanyAboutController::class, 'index'])->name('.index');
        Route::get('/create', [CompanyAboutController::class, 'create'])->name('.create');
        Route::post('/', [CompanyAboutController::class, 'store'])->name('.store');
        Route::get('/{companyAbout}', [CompanyAboutController::class, 'show'])->name('.show');
        Route::get('/{companyAbout}/edit', [CompanyAboutController::class, 'edit'])->name('.edit');
        Route::put('/{companyAbout}', [CompanyAboutController::class, 'update'])->name('.update');
        Route::delete('/{companyAbout}', [CompanyAboutController::class, 'destroy'])->name('.destroy');
    });

    Route::group(['prefix' => 'work-flows', 'as' => '.work_flows'], function () {
        Route::get('/', [WorkFlowController::class, 'index'])->name('.index');
        Route::get('/create', [WorkFlowController::class, 'create'])->name('.create');
        Route::post('/', [WorkFlowController::class, 'store'])->name('.store');
        Route::get('/{workFlow}', [WorkFlowController::class, 'show'])->name('.show');
        Route::get('/{workFlow}/edit', [WorkFlowController::class, 'edit'])->name('.edit');
        Route::put('/{workFlow}', [WorkFlowController::class, 'update'])->name('.update');
        Route::delete('/{workFlow}', [WorkFlowController::class, 'destroy'])->name('.destroy');
    });


    Route::group(['prefix' => 'partners', 'as' => '.partners'], function () {
        Route::get('/', [PartnerController::class, 'index'])->name('.index');
        Route::get('/create', [PartnerController::class, 'create'])->name('.create');
        Route::post('/', [PartnerController::class, 'store'])->name('.store');
        Route::get('/{partner}/edit', [PartnerController::class, 'edit'])->name('.edit');
        Route::put('/{partner}', [PartnerController::class, 'update'])->name('.update');
        Route::delete('/{partner}', [PartnerController::class, 'destroy'])->name('.destroy');
    });


    



});