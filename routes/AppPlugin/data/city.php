<?php

use App\AppPlugin\Data\City\CityController;
use Illuminate\Support\Facades\Route;

Route::get('/city/',[CityController::class,'index'])->name('data.DataCity.index');
Route::post('/city/', [CityController::class, 'index'])->name('data.DataCity.filter');
Route::get('/city/DataTable',[CityController::class,'DataTable'])->name('data.DataCity.DataTable');
Route::get('/city/create',[CityController::class,'create'])->name('data.DataCity.create');
Route::get('/city/edit/{id}',[CityController::class,'edit'])->name('data.DataCity.edit');
Route::post('/city/update/{id}',[CityController::class,'storeUpdate'])->name('data.DataCity.update');
Route::get('/city/destroy/{id}',[CityController::class,'ForceDeleteException'])->name('data.DataCity.destroy');
