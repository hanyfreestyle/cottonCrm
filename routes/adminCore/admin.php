<?php
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HooverDataController;
use Illuminate\Support\Facades\Route;




Route::get('/',[DashboardController::class,'Dashboard'])->name('Dashboard');
Route::get('/testpdf',[DashboardController::class,'testpdf'])->name('testpdf');

//Route::get('/updateCatLang',[DashboardController::class,'updateCatLang'])->name('updateCatLang');
//Route::get('/updateBrandLang',[DashboardController::class,'updateBrandLang'])->name('updateBrandLang');
//Route::get('/UpdateTagLang',[DashboardController::class,'UpdateTagLang'])->name('UpdateTagLang');
//Route::get('/UpdateBlogLang',[DashboardController::class,'UpdateBlogLang'])->name('UpdateBlogLang');

Route::get('/getConfigData',[HooverDataController::class,'getConfigData'])->name('getConfigData');






