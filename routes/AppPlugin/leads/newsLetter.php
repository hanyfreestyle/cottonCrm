<?php


use App\AppPlugin\Leads\NewsLetter\NewsLetterController;
use Illuminate\Support\Facades\Route;

Route::get('/config/news-letter/', [NewsLetterController::class, 'index'])->name('config.NewsLetter.index');
Route::get('/config/news-letter/dataTable', [NewsLetterController::class,'DataTable'])->name('config.NewsLetter.DataTable');
Route::post('/config/news-letter/', [NewsLetterController::class, 'index'])->name('config.NewsLetter.filter');
Route::get('/config/news-letter/config', [NewsLetterController::class, 'config'])->name('config.NewsLetter.config');
Route::get('/config/news-letter/ExportFile', [NewsLetterController::class, 'Export'])->name('config.NewsLetter.Export');
Route::post('/config/news-letter/ExportFile', [NewsLetterController::class, 'Export'])->name('config.NewsLetter.Export');
Route::get('/config/news-letter/{id}', [NewsLetterController::class,'destroy'])->name('config.NewsLetter.destroy');

