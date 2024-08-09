<?php


use App\AppPlugin\Data\Country\CountryController;
use Illuminate\Support\Facades\Route;


Route::get('/Country/',[CountryController::class,'index'])->name('data.Country.index');
Route::post('/Country/', [CountryController::class, 'index'])->name('data.Country.filter');
Route::get('/Country/DataTable',[CountryController::class,'DataTable'])->name('data.Country.DataTable');
Route::get('/Country/create',[CountryController::class,'create'])->name('data.Country.create');
Route::get('/Country/create/ar',[CountryController::class,'create'])->name('data.Country.create_ar');
Route::get('/Country/create/en',[CountryController::class,'create'])->name('data.Country.create_en');
Route::get('/Country/edit/{id}',[CountryController::class,'edit'])->name('data.Country.edit');
Route::get('/Country/emptyPhoto/{id}', [CountryController::class,'emptyPhoto'])->name('data.Country.emptyPhoto');
Route::post('/Country/update/{id}',[CountryController::class,'storeUpdate'])->name('data.Country.update');
Route::get('/Country/destroy/{id}',[CountryController::class,'ForceDeleteException'])->name('data.Country.destroy');
Route::post('/Country/updateStatus', [CountryController::class,'updateStatus'])->name('data.Country.updateStatus');
