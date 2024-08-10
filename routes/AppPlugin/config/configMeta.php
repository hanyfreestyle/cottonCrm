<?php


use App\AppPlugin\Config\Meta\MetaTagController;
use Illuminate\Support\Facades\Route;

Route::get('/meta-tag/', [MetaTagController::class, 'index'])->name('config.Meta.index');
Route::get('/meta-tag/DataTable/', [MetaTagController::class, 'DataTable'])->name('config.Meta.DataTable');
Route::get('/meta-tag/create', [MetaTagController::class, 'create'])->name('config.Meta.create');
Route::get('/meta-tag/edit/{id}', [MetaTagController::class, 'edit'])->name('config.Meta.edit');
Route::post('/meta-tag/Update/{id}', [MetaTagController::class, 'storeUpdate'])->name('config.Meta.update');
Route::get('/meta-tag/delete/{id}', [MetaTagController::class, 'destroy'])->name('config.Meta.destroy');
Route::get('/meta-tag/emptyPhoto/{id}', [MetaTagController::class, 'emptyPhoto'])->name('config.Meta.emptyPhoto');



