<?php
use App\AppPlugin\Config\WebLangFile\LangFileWebController;
use Illuminate\Support\Facades\Route;

Route::get('/web-lang',[LangFileWebController::class,'index'])->name('weblang.index');
Route::get('/web-lang/edit',[LangFileWebController::class,'EditLang'])->name('weblang.edit');
Route::post('/web-lang/updateFile',[LangFileWebController::class,'updateFile'])->name('weblang.updateFile');

