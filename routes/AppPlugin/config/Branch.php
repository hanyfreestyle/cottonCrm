<?php


use App\AppPlugin\Config\Branche\BranchController;
use Illuminate\Support\Facades\Route;

Route::get('/Branch', [BranchController::class, 'index'])->name('config.Branch.index');
Route::get('/Branch/create',[BranchController::class,'create'])->name('config.Branch.create');
Route::get('/Branch/edit/{id}',[BranchController::class,'edit'])->name('config.Branch.edit');
Route::get('/Branch/destroy/{id}',[BranchController::class,'destroy'])->name('config.Branch.destroy');
Route::post('/Branch/update/{id}',[BranchController::class,'storeUpdate'])->name('config.Branch.update');
Route::get('/Branch/Sort',[BranchController::class,'Sort'])->name('config.Branch.Sort');
Route::post('/Branch/SaveSort',[BranchController::class,'SaveSort'])->name('config.Branch.SaveSort');
Route::get('/Branch/config', [BranchController::class,'config'])->name('config.Branch.config');
Route::get('/Branch/SoftDelete/',[BranchController::class,'SoftDeletes'])->name('config.Branch.SoftDelete');
Route::get('/Branch/restore/{id}',[BranchController::class,'Restore'])->name('config.Branch.restore');
Route::get('/Branch/force/{id}',[BranchController::class,'ForceDelete'])->name('config.Branch.force');

