<?php


use App\AppPlugin\Data\DataLeadSours\DataLeadSoursController;
use Illuminate\Support\Facades\Route;

Route::get('/lead-sours/',[DataLeadSoursController::class,'indexData'])->name('data.LeadSours.index');
Route::get('/lead-sours/archived',[DataLeadSoursController::class,'indexData'])->name('data.LeadSours.archived');
Route::get('/lead-sours/DataTable',[DataLeadSoursController::class,'DataTable'])->name('data.LeadSours.DataTable');
Route::get('/lead-sours/DataTable/archived',[DataLeadSoursController::class,'DataTableArchived'])->name('data.LeadSours.DataTableArchived');
Route::get('/lead-sours/create',[DataLeadSoursController::class,'createData'])->name('data.LeadSours.create');
Route::get('/lead-sours/edit/{id}',[DataLeadSoursController::class,'editData'])->name('data.LeadSours.edit');
Route::post('/lead-sours/update/{id}',[DataLeadSoursController::class,'storeUpdateData'])->name('data.LeadSours.update');
Route::get('/lead-sours/destroy/{id}',[DataLeadSoursController::class,'ForceDeleteException'])->name('data.LeadSours.destroy');
Route::get('/lead-sours/config', [DataLeadSoursController::class,'configData'])->name('data.LeadSours.config');
