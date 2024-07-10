<?php


use App\AppPlugin\Crm\Periodicals\PeriodicalsController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsReportController;
use Illuminate\Support\Facades\Route;


Route::get('/book/Periodicals/',[PeriodicalsController::class,'index'])->name('Periodicals.index');
Route::post('/book/Periodicals/', [PeriodicalsController::class, 'index'])->name('Periodicals.filter');
Route::get('/book/Periodicals/DataTable',[PeriodicalsController::class,'DataTable'])->name('Periodicals.DataTable');
Route::get('/book/Periodicals/create',[PeriodicalsController::class,'create'])->name('Periodicals.create');
Route::get('/book/Periodicals/edit/{id}',[PeriodicalsController::class,'edit'])->name('Periodicals.edit');
Route::post('/book/Periodicals/update/{id}',[PeriodicalsController::class,'storeUpdate'])->name('Periodicals.update');
Route::get('/book/Periodicals/destroy/{id}',[PeriodicalsController::class,'ForceDeleteException'])->name('Periodicals.destroy');
Route::get('/book/Periodicals/config', [PeriodicalsController::class,'config'])->name('Periodicals.config');


Route::get('/book/Periodicals/report/',[PeriodicalsReportController::class,'report'])->name('Periodicals.Report.index');
Route::post('/book/Periodicals/report/', [PeriodicalsReportController::class, 'report'])->name('Periodicals.Report.filter');

