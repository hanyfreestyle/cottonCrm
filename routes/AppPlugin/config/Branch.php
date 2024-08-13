<?php


use App\AppPlugin\Config\Branche\BranchController;
use Illuminate\Support\Facades\Route;

Route::get('/branch/', [BranchController::class, 'index'])->name('config.Branch.index');
Route::get('/branch/create',[BranchController::class,'create'])->name('config.Branch.create');
Route::get('/branch/edit/{id}',[BranchController::class,'edit'])->name('config.Branch.edit');
Route::get('/branch/destroy/{id}',[BranchController::class,'destroy'])->name('config.Branch.destroy');
Route::post('/branch/update/{id}',[BranchController::class,'storeUpdate'])->name('config.Branch.update');
Route::get('/branch/sort',[BranchController::class,'Sort'])->name('config.Branch.Sort');
Route::post('/branch/save-sort',[BranchController::class,'SaveSort'])->name('config.Branch.SaveSort');
Route::get('/branch/config', [BranchController::class,'config'])->name('config.Branch.config');

