<?php


use App\AppPlugin\Crm\ImportData\ImportDataController;
use App\AppPlugin\Crm\ImportData\ImportDataIndexController;
use Illuminate\Support\Facades\Route;


Route::get('/uploadExcel',[ImportDataController::class,'uploadExcel'])->name('uploadExcel');
Route::get('/CheckNames',[ImportDataController::class,'CheckNames'])->name('CheckNames');

Route::get('/ListImport',[ImportDataIndexController::class,'index'])->name('ListImport');
Route::get('/ListImport/DataTable',[ImportDataIndexController::class,'DataTable'])->name('ListImport.DataTable');

Route::get('/CheckNum',[ImportDataController::class,'CheckNum'])->name('CheckNum');
Route::get('/CheckNum1',[ImportDataController::class,'CheckNum1'])->name('CheckNum1');
Route::get('/CheckNum2',[ImportDataController::class,'CheckNum2'])->name('CheckNum2');
Route::get('/CheckNum3',[ImportDataController::class,'CheckNum3'])->name('CheckNum3');
Route::get('/CheckNum4',[ImportDataController::class,'CheckNum4'])->name('CheckNum4');
Route::get('/CheckNum5',[ImportDataController::class,'CheckNum5'])->name('CheckNum5');
Route::get('/checkCountry',[ImportDataController::class,'checkCountry'])->name('checkCountry');
Route::get('/checkCountryU',[ImportDataController::class,'checkCountryU'])->name('checkCountryU');
Route::get('/checkCountryOM',[ImportDataController::class,'checkCountryOM'])->name('checkCountryOM');
