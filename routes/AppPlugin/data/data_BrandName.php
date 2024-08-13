<?php


use App\AppPlugin\Data\DataBrandName\DataBrandNameController;
use Illuminate\Support\Facades\Route;

Route::get('/brand/',[DataBrandNameController::class,'indexData'])->name('data.BrandName.index');
Route::get('/brand/archived',[DataBrandNameController::class,'indexData'])->name('data.BrandName.archived');
Route::get('/brand/DataTable',[DataBrandNameController::class,'DataTable'])->name('data.BrandName.DataTable');
Route::get('/brand/DataTable/archived',[DataBrandNameController::class,'DataTableArchived'])->name('data.BrandName.DataTableArchived');
Route::get('/brand/create',[DataBrandNameController::class,'createData'])->name('data.BrandName.create');
Route::get('/brand/edit/{id}',[DataBrandNameController::class,'editData'])->name('data.BrandName.edit');
Route::post('/brand/update/{id}',[DataBrandNameController::class,'storeUpdateData'])->name('data.BrandName.update');
Route::get('/brand/destroy/{id}',[DataBrandNameController::class,'ForceDeleteException'])->name('data.BrandName.destroy');
Route::get('/brand/config', [DataBrandNameController::class,'configData'])->name('data.BrandName.config');
