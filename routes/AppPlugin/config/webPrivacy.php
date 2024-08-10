<?php


use App\AppPlugin\Config\Privacy\WebPrivacyController;
use Illuminate\Support\Facades\Route;

Route::get('/web-privacy/', [WebPrivacyController::class,'index'])->name('config.WebPrivacy.index');
Route::get('/web-privacy/create', [WebPrivacyController::class,'create'])->name('config.WebPrivacy.create');
Route::get('/web-privacy/edit/{id}', [WebPrivacyController::class,'edit'])->name('config.WebPrivacy.edit');
Route::post('/web-privacy/Update/{id}', [WebPrivacyController::class,'storeUpdate'])->name('config.WebPrivacy.update');
Route::get('/web-privacy/delete/{id}', [WebPrivacyController::class,'destroy'])->name('config.WebPrivacy.destroy');
Route::get('/web-privacy/config', [WebPrivacyController::class,'config'])->name('config.WebPrivacy.config');
Route::get('/web-privacy/SoftDelete/',[WebPrivacyController::class,'SoftDeletes'])->name('config.WebPrivacy.SoftDelete');
Route::get('/web-privacy/restore/{id}',[WebPrivacyController::class,'Restore'])->name('config.WebPrivacy.restore');
Route::get('/web-privacy/force/{id}',[WebPrivacyController::class,'ForceDelete'])->name('config.WebPrivacy.force');
Route::get('/web-privacy/Sort',[WebPrivacyController::class,'Sort'])->name('config.WebPrivacy.Sort');
Route::post('/web-privacy/SaveSort', [WebPrivacyController::class,'SaveSort'])->name('config.WebPrivacy.SaveSort');
