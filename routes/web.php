<?php

use App\AppPlugin\Customers\ShoppingCartController;
use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\RouteNotFoundController;
use App\Http\Controllers\web\BlogViewController;
use App\Http\Controllers\web\BrandViewController;
use App\Http\Controllers\web\PagesViewController;
use App\Http\Controllers\web\ProductsCategoriesViewController;
use App\Http\Controllers\web\ProductsPageController;
use App\Http\Controllers\web\ProductsViewController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['prefix' => config('app.configAdminDir')], function () {
        Route::get('/admin-login', [AuthAdminController::class, 'AdminLogIn'])->name('admin.login');
        Route::post('/loginCheck', [AuthAdminController::class, 'AdminLoginCheck'])->name('AdminLoginCheck');
        Route::post('/logout', [AuthAdminController::class, 'AdminLogout'])->name('admin.logout');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/under-construction', [PagesViewController::class, 'UnderConstruction'])->name('UnderConstruction');
});


Route::group(['middleware' => ['UnderConstruction', 'MinifyHtml']], function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::get('/', [PagesViewController::class, 'index'])->name('page_index');

    });
});

Route::fallback(RouteNotFoundController::class);

