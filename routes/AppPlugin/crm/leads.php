<?php

use App\AppPlugin\Crm\Leads\CrmLeadsController;
use Illuminate\Support\Facades\Route;


Route::get('/leads/add-new', [CrmLeadsController::class, 'AddNew'])->name('CrmLeads.addNew');
Route::post('/leads/search/', [CrmLeadsController::class, 'searchFilter'])->name('CrmLeads.searchFilter');
Route::get('/leads/add-ticket/{customerID}', [CrmLeadsController::class, 'addTicket'])->name('CrmLeads.addTicket');
Route::post('/leads/add-ticket/{customerID}', [CrmLeadsController::class, 'CreateTicket'])->name('CrmLeads.createTicket');
Route::post('/leads/update-ticket/{id}', [CrmLeadsController::class, 'UpdateTicket'])->name('CrmLeads.updateTicket');
Route::get('/leads/distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('CrmLeads.distribution');

Route::get('/leads/edit/{id}', [CrmLeadsController::class, 'editTicket'])->name('CrmLeads.edit');
Route::get('/leads/destroy/{id}', [CrmLeadsController::class, 'destroy'])->name('CrmLeads.destroy');

Route::get('/leads/view-info/{id}', [CrmLeadsController::class, 'ViewInfo'])->name('CrmLeads.viewInfo');


//Route::get('leads/distribution/DataTable', [CrmLeadsController::class, 'DataTable'])->name('CrmLeads.DataTable');
//Route::get('/crm/customers/create', [CrmTicketsController::class, 'create'])->name('CrmCustomer.create');
//Route::get('/crm/customers/addNew', [CrmTicketsController::class, 'create'])->name('CrmCustomer.addNew');

//Route::get('/crm/customers/profile/{id}', [CrmTicketsController::class, 'profile'])->name('CrmCustomer.profile');
//Route::get('/crm/customers/emptyPhoto/{id}', [CrmTicketsController::class, 'emptyPhoto'])->name('CrmCustomer.emptyPhoto');
//Route::post('/crm/customers/update/{id}', [CrmTicketsController::class, 'storeUpdate'])->name('CrmCustomer.update');

//Route::get('/crm/customers/config', [CrmTicketsController::class, 'config'])->name('CrmCustomer.config');
//Route::get('/crm/customers/repeat/{num}', [CrmTicketsController::class, 'repeat'])->name('CrmCustomer.repeat');


