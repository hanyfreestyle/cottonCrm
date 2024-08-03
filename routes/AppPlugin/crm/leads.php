<?php

use App\AppPlugin\Crm\Leads\CrmLeadsController;
use Illuminate\Support\Facades\Route;


Route::get('/leads/add-new', [CrmLeadsController::class, 'AddNew'])->name('CrmLeads.addNew');
Route::post('/leads/search/', [CrmLeadsController::class, 'searchFilter'])->name('CrmLeads.searchFilter');

Route::get('/leads/add-ticket/{customerID}', [CrmLeadsController::class, 'addTicket'])->name('CrmLeads.addTicket');
Route::post('/leads/add-ticket/{customerID}', [CrmLeadsController::class, 'CreateTicket'])->name('CrmLeads.createTicket');

Route::get('/leads/edit/{id}', [CrmLeadsController::class, 'editTicket'])->name('CrmLeads.edit');
Route::post('/leads/update-ticket/{id}', [CrmLeadsController::class, 'UpdateTicket'])->name('CrmLeads.updateTicket');

Route::get('/leads/distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('CrmLeads.distribution');
Route::post('/leads/distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('CrmLeads.filter');
Route::post('/leads/add-to-user/', [CrmLeadsController::class, 'AddToUser'])->name('CrmLeads.addToUser');
Route::get('/leads/destroy/{id}', [CrmLeadsController::class, 'destroy'])->name('CrmLeads.destroy');

Route::get('/leads/report/', [CrmLeadsController::class, 'Report'])->name('CrmLeads.report');
Route::post('/leads/report/', [CrmLeadsController::class, 'Report'])->name('CrmLeads.filterReport');
Route::get('/leads/view-info/{id}', [CrmLeadsController::class, 'ViewInfo'])->name('CrmLeads.viewInfo');






