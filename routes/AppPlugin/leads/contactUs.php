<?php

use App\AppPlugin\Leads\ContactUs\ContactUsFormController;
use Illuminate\Support\Facades\Route;

Route::get('/LeadsFrom/Request',[ContactUsFormController::class,'indexAll'])->name('LeadsFrom.Request.index');
Route::post('/LeadsFrom/Request', [ContactUsFormController::class, 'indexAll'])->name('LeadsFrom.Request.filter');
Route::get('/RequestCall/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Request.Export');
Route::post('/RequestCall/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Request.Export');
Route::get('/RequestCall/destroy/{id}', [ContactUsFormController::class,'destroy'])->name('LeadsFrom.Request.destroy');

Route::get('/LeadsFrom/ContactUs',[ContactUsFormController::class,'indexAll'])->name('LeadsFrom.ContactUs.index');
Route::post('/LeadsFrom/ContactUs', [ContactUsFormController::class, 'indexAll'])->name('LeadsFrom.ContactUs.filter');
Route::get('/ContactUs/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.ContactUs.Export');
Route::post('/ContactUs/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.ContactUs.Export');
Route::get('/ContactUs/destroy/{id}', [ContactUsFormController::class,'destroy'])->name('LeadsFrom.ContactUs.destroy');

Route::get('/LeadsFrom/Meeting',[ContactUsFormController::class,'indexAll'])->name('LeadsFrom.Meeting.index');
Route::post('/LeadsFrom/Meeting', [ContactUsFormController::class, 'indexAll'])->name('LeadsFrom.Meeting.filter');
Route::get('/Meeting/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Meeting.Export');
Route::post('/Meeting/ExportFile', [ContactUsFormController::class, 'Export'])->name('LeadsFrom.Meeting.Export');
Route::get('/Meeting/destroy/{id}', [ContactUsFormController::class,'destroy'])->name('LeadsFrom.Meeting.destroy');


Route::get('/LeadsFrom/config', [ContactUsFormController::class, 'config'])->name('LeadsFrom.config');

