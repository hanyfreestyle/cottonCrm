<?php


use App\AppPlugin\Crm\CrmService\Leads\CrmLeadsController;
use Illuminate\Support\Facades\Route;


Route::get('/leads/search/', [CrmLeadsController::class, 'SearchFormCustomer'])->name('CrmLeads.SearchFormCustomer');
Route::post('/leads/search-filter/', [CrmLeadsController::class, 'SearchFormCustomerFilter'])->name('CrmLeads.searchFilter');

Route::get('/leads/add-ticket/{customerID}', [CrmLeadsController::class, 'addTicket'])->name('CrmLeads.addTicket');
Route::post('/leads/create-ticket/{customerID}', [CrmLeadsController::class, 'CreateTicket'])->name('CrmLeads.createTicket');

Route::get('/leads/edit/{id}', [CrmLeadsController::class, 'editTicket'])->name('CrmLeads.edit');
Route::post('/leads/update-ticket/{id}', [CrmLeadsController::class, 'UpdateTicket'])->name('CrmLeads.updateTicket');

Route::get('/leads/distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('CrmLeads.distribution');
Route::post('/leads/distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('CrmLeads.filter');
Route::post('/leads/add-to-user/', [CrmLeadsController::class, 'AddToUser'])->name('CrmLeads.addToUser');
Route::get('/leads/destroy/{id}', [CrmLeadsController::class, 'destroy'])->name('CrmLeads.destroy');

Route::get('/leads/report/', [CrmLeadsController::class, 'report'])->name('CrmLeads.report');
Route::post('/leads/report/', [CrmLeadsController::class, 'report'])->name('CrmLeads.filterReport');






