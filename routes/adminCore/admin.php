<?php

use App\AppPlugin\Crm\Periodicals\BookDashboardController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HooverDataController;
use Illuminate\Support\Facades\Route;



if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
    Route::get('/',[BookDashboardController::class,'Dashboard'])->name('Dashboard');
    Route::get('/selRelease/{id}',[BookDashboardController::class,'Dashboard'])->name('Dashboard.selRelease');
    Route::post('/',[BookDashboardController::class,'DashboardFilter'])->name('Dashboard.filter');
}else{
    Route::get('/',[DashboardController::class,'Dashboard'])->name('Dashboard');
}



Route::get('/testpdf',[DashboardController::class,'testpdf'])->name('testpdf');

//Route::get('/updateCatLang',[DashboardController::class,'updateCatLang'])->name('updateCatLang');
//Route::get('/updateBrandLang',[DashboardController::class,'updateBrandLang'])->name('updateBrandLang');
//Route::get('/UpdateTagLang',[DashboardController::class,'UpdateTagLang'])->name('UpdateTagLang');
//Route::get('/UpdateBlogLang',[DashboardController::class,'UpdateBlogLang'])->name('UpdateBlogLang');

Route::get('/getConfigData',[HooverDataController::class,'getConfigData'])->name('getConfigData');






