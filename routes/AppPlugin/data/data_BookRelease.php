<?php


use App\AppPlugin\Data\DataBookRelease\DataBookReleaseController;
use Illuminate\Support\Facades\Route;

Route::get('/Release/',[DataBookReleaseController::class,'indexData'])->name('data.BookRelease.index');
Route::get('/Release/archived',[DataBookReleaseController::class,'indexData'])->name('data.BookRelease.archived');
Route::get('/Release/DataTable',[DataBookReleaseController::class,'DataTable'])->name('data.BookRelease.DataTable');
Route::get('/Release/DataTable/archived',[DataBookReleaseController::class,'DataTableArchived'])->name('data.BookRelease.DataTableArchived');
Route::get('/Release/create',[DataBookReleaseController::class,'createData'])->name('data.BookRelease.create');
Route::get('/Release/edit/{id}',[DataBookReleaseController::class,'editData'])->name('data.BookRelease.edit');
Route::post('/Release/update/{id}',[DataBookReleaseController::class,'storeUpdateData'])->name('data.BookRelease.update');
Route::get('/Release/destroy/{id}',[DataBookReleaseController::class,'ForceDeleteException'])->name('data.BookRelease.destroy');
Route::get('/Release/config', [DataBookReleaseController::class,'configData'])->name('data.BookRelease.config');
