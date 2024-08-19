<?php


use App\AppPlugin\Data\Country\CountryController;
use Illuminate\Support\Facades\Route;


Route::get('/country/',[CountryController::class,'index'])->name('data.Country.index');
Route::post('/country/', [CountryController::class, 'index'])->name('data.Country.filter');
Route::get('/country/DataTable',[CountryController::class,'DataTable'])->name('data.Country.DataTable');
Route::get('/country/create',[CountryController::class,'create'])->name('data.Country.create');
Route::get('/country/create/ar',[CountryController::class,'create'])->name('data.Country.create_ar');
Route::get('/country/create/en',[CountryController::class,'create'])->name('data.Country.create_en');
Route::get('/country/edit/{id}',[CountryController::class,'edit'])->name('data.Country.edit');
Route::get('/country/emptyPhoto/{id}', [CountryController::class,'emptyPhoto'])->name('data.Country.emptyPhoto');
Route::post('/country/update/{id}',[CountryController::class,'storeUpdate'])->name('data.Country.update');
Route::get('/country/destroy/{id}',[CountryController::class,'ForceDeleteException'])->name('data.Country.destroy');
Route::post('/country/updateStatus', [CountryController::class,'updateStatus'])->name('data.Country.updateStatus');
