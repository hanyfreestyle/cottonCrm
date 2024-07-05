<?php


use App\AppPlugin\Data\DataEvaluationCust\DataEvaluationCustController;
use Illuminate\Support\Facades\Route;

Route::get('/evaluation/',[DataEvaluationCustController::class,'indexData'])->name('data.EvaluationCust.index');
Route::get('/evaluation/archived',[DataEvaluationCustController::class,'indexData'])->name('data.EvaluationCust.archived');
Route::get('/evaluation/DataTable',[DataEvaluationCustController::class,'DataTable'])->name('data.EvaluationCust.DataTable');
Route::get('/evaluation/DataTable/archived',[DataEvaluationCustController::class,'DataTableArchived'])->name('data.EvaluationCust.DataTableArchived');
Route::get('/evaluation/create',[DataEvaluationCustController::class,'createData'])->name('data.EvaluationCust.create');
Route::get('/evaluation/edit/{id}',[DataEvaluationCustController::class,'editData'])->name('data.EvaluationCust.edit');
Route::post('/evaluation/update/{id}',[DataEvaluationCustController::class,'storeUpdateData'])->name('data.EvaluationCust.update');
Route::get('/evaluation/destroy/{id}',[DataEvaluationCustController::class,'ForceDeleteException'])->name('data.EvaluationCust.destroy');
Route::get('/evaluation/config', [DataEvaluationCustController::class,'configData'])->name('data.EvaluationCust.config');
