<?php


use App\AppPlugin\Leads\NewsLetter\NewsLetterController;
use Illuminate\Support\Facades\Route;

Route::get('/config/NewsLetter', [NewsLetterController::class, 'index'])->name('config.NewsLetter.index');
Route::post('/config/NewsLetter', [NewsLetterController::class, 'index'])->name('config.NewsLetter.filter');
Route::get('/config/NewsLetter/config', [NewsLetterController::class, 'config'])->name('config.NewsLetter.config');
Route::get('/config/NewsLetter/ExportFile', [NewsLetterController::class, 'Export'])->name('config.NewsLetter.Export');
Route::post('/config/NewsLetter/ExportFile', [NewsLetterController::class, 'Export'])->name('config.NewsLetter.Export');
Route::get('/config/NewsLetter/{id}', [NewsLetterController::class,'destroy'])->name('config.NewsLetter.destroy');

