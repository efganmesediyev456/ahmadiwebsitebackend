<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\Regulations\LanguageController;
use App\Http\Controllers\Backend\Regulations\TranslationController;
use App\Http\Controllers\Backend\ServiceCategoryController;
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


});







