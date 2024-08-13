<?php

use App\AppPlugin\Data\Area\AreaController;
use Illuminate\Support\Facades\Route;


Route::get('/area/',[AreaController::class,'index'])->name('data.DataArea.index');
Route::post('/area/', [AreaController::class, 'index'])->name('data.DataArea.filter');
Route::get('/area/DataTable',[AreaController::class,'DataTable'])->name('data.DataArea.DataTable');
Route::get('/area/create',[AreaController::class,'create'])->name('data.DataArea.create');
Route::get('/area/edit/{id}',[AreaController::class,'edit'])->name('data.DataArea.edit');
Route::post('/area/update/{id}',[AreaController::class,'storeUpdate'])->name('data.DataArea.update');
Route::get('/area/destroy/{id}',[AreaController::class,'ForceDeleteException'])->name('data.DataArea.destroy');
Route::post('/api/fetch-city', [AreaController::class,'fetchCity'])->name('api.fetch-city');
Route::post('/api/fetch-area', [AreaController::class,'fetchArea'])->name('api.fetch-area');

