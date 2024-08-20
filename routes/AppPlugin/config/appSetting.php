<?php

use App\AppPlugin\Config\Apps\AppMenuController;
use App\AppPlugin\Config\Apps\AppSettingController;
use Illuminate\Support\Facades\Route;


Route::get('/app/setting', [AppSettingController::class, 'AppSetting'])->name('App.AppSetting.form');
Route::post('/app/settingUpdate', [AppSettingController::class, 'AppSettingUpdate'])->name('App.AppSetting.AppSettingUpdate');
Route::get('/app/photo', [AppSettingController::class, 'AppPhotos'])->name('App.AppPhotos.form');
Route::post('/app/photoUpdate', [AppSettingController::class, 'photoUpdate'])->name('App.AppSetting.photoUpdate');

Route::get('/app/MenuList', [AppMenuController::class, 'index'])->name('App.AppMenu.index');
Route::get('/app/Menu/create', [AppMenuController::class, 'create'])->name('App.AppMenu.create');
Route::get('/app/Menu/edit/{id}', [AppMenuController::class, 'edit'])->name('App.AppMenu.edit');
Route::get('/app/Menu/destroy/{id}', [AppMenuController::class, 'destroy'])->name('App.AppMenu.destroy');
Route::post('/app/Menu/update/{id}', [AppMenuController::class, 'storeUpdate'])->name('App.AppMenu.update');
Route::get('/app/Menu/Sort', [AppMenuController::class, 'Sort'])->name('App.AppMenu.Sort');
Route::post('/app/Menu/SaveSort', [AppMenuController::class, 'SaveSort'])->name('App.AppMenu.SaveSort');
Route::get('/app/Menu/SoftDelete/', [AppMenuController::class, 'SoftDeletes'])->name('App.AppMenu.SoftDelete');
Route::get('/app/Menu/restore/{id}', [AppMenuController::class, 'Restore'])->name('App.AppMenu.restore');
Route::get('/app/Menu/force/{id}', [AppMenuController::class, 'ForceDelete'])->name('App.AppMenu.force');
Route::get('/app/Menu/config', [AppMenuController::class, 'config'])->name('App.AppMenu.config');

Route::get('/app/profile', [AppSettingController::class, 'AppProfile'])->name('App.AppProfile.form');
Route::get('/app/cart', [AppSettingController::class, 'AppProfile'])->name('App.AppCart.form');
Route::post('/app/profileUpdate', [AppSettingController::class, 'AppProfileUpdate'])->name('App.AppProfileUpdate');
