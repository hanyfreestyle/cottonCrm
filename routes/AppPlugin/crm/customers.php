<?php

use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\CrmCustomersReportController;
use Illuminate\Support\Facades\Route;


Route::get('/crm/customers/', [CrmCustomersController::class, 'index'])->name('CrmCustomer.index');
Route::post('/crm/customers/', [CrmCustomersController::class, 'index'])->name('CrmCustomer.filter');
Route::get('crm/customers/DataTable', [CrmCustomersController::class, 'DataTable'])->name('CrmCustomer.DataTable');
Route::get('/crm/customers/create', [CrmCustomersController::class, 'create'])->name('CrmCustomer.create');
Route::get('/crm/customers/addNew', [CrmCustomersController::class, 'create'])->name('CrmCustomer.addNew');
Route::get('/crm/customers/edit/{id}', [CrmCustomersController::class, 'edit'])->name('CrmCustomer.edit');
Route::get('/crm/customers/profile/{id}', [CrmCustomersController::class, 'profile'])->name('CrmCustomer.profile');
Route::get('/crm/customers/emptyPhoto/{id}', [CrmCustomersController::class, 'emptyPhoto'])->name('CrmCustomer.emptyPhoto');
Route::post('/crm/customers/update/{id}', [CrmCustomersController::class, 'storeUpdate'])->name('CrmCustomer.update');
Route::get('/crm/customers/destroy/{id}', [CrmCustomersController::class, 'ForceDeleteException'])->name('CrmCustomer.destroy');
Route::get('/crm/customers/config', [CrmCustomersController::class, 'config'])->name('CrmCustomer.config');
Route::get('/crm/customers/repeat/{num}', [CrmCustomersController::class, 'repeat'])->name('CrmCustomer.repeat');

Route::get('/crm/customers/report/', [CrmCustomersReportController::class, 'report'])->name('CrmCustomer.Report.index');
Route::post('/crm/customers/report/', [CrmCustomersReportController::class, 'report'])->name('CrmCustomer.Report.filter');



