<?php


use App\AppPlugin\Data\DataBookLang\DataBookLangController;
use Illuminate\Support\Facades\Route;

Route::get('/bookLang/',[DataBookLangController::class,'indexData'])->name('data.BookLang.index');
Route::get('/bookLang/archived',[DataBookLangController::class,'indexData'])->name('data.BookLang.archived');
Route::get('/bookLang/DataTable',[DataBookLangController::class,'DataTable'])->name('data.BookLang.DataTable');
Route::get('/bookLang/DataTable/archived',[DataBookLangController::class,'DataTableArchived'])->name('data.BookLang.DataTableArchived');
Route::get('/bookLang/create',[DataBookLangController::class,'createData'])->name('data.BookLang.create');
Route::get('/bookLang/edit/{id}',[DataBookLangController::class,'editData'])->name('data.BookLang.edit');
Route::post('/bookLang/update/{id}',[DataBookLangController::class,'storeUpdateData'])->name('data.BookLang.update');
Route::get('/bookLang/destroy/{id}',[DataBookLangController::class,'ForceDeleteException'])->name('data.BookLang.destroy');
Route::get('/bookLang/config', [DataBookLangController::class,'configData'])->name('data.BookLang.config');
