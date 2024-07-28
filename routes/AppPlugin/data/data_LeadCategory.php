<?php


use App\AppPlugin\Data\DataLeadCategory\DataLeadCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/lead-category/',[DataLeadCategoryController::class,'indexData'])->name('data.LeadCategory.index');
Route::get('/lead-category/DataTable',[DataLeadCategoryController::class,'DataTable'])->name('data.LeadCategory.DataTable');
Route::get('/lead-category/DataTable/archived',[DataLeadCategoryController::class,'DataTableArchived'])->name('data.LeadCategory.DataTableArchived');

Route::get('/lead-category/archived',[DataLeadCategoryController::class,'indexData'])->name('data.LeadCategory.archived');
Route::get('/lead-category/create',[DataLeadCategoryController::class,'createData'])->name('data.LeadCategory.create');
Route::get('/lead-category/edit/{id}',[DataLeadCategoryController::class,'editData'])->name('data.LeadCategory.edit');
Route::post('/lead-category/update/{id}',[DataLeadCategoryController::class,'storeUpdateData'])->name('data.LeadCategory.update');
Route::get('/lead-category/destroy/{id}',[DataLeadCategoryController::class,'ForceDeleteException'])->name('data.LeadCategory.destroy');
Route::get('/lead-category/config', [DataLeadCategoryController::class,'configData'])->name('data.LeadCategory.config');
