<?php
use App\AppPlugin\Crm\CrmService\Leads\CrmLeadsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/leads/')->name('CrmLeads.')->group(function () {
    Route::get('search/', [CrmLeadsController::class, 'SearchFormCustomer'])->name('SearchFormCustomer');
    Route::post('search-filter/', [CrmLeadsController::class, 'SearchFormCustomerFilter'])->name('searchFilter');

    Route::get('add-ticket/{customerID}', [CrmLeadsController::class, 'addTicket'])->name('addTicket');
    Route::post('create-ticket/{customerID}', [CrmLeadsController::class, 'CreateTicket'])->name('createTicket');

    Route::get('edit/{id}', [CrmLeadsController::class, 'editTicket'])->name('edit');
    Route::post('update-ticket/{id}', [CrmLeadsController::class, 'UpdateTicket'])->name('updateTicket');

    Route::get('distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('distribution');
    Route::post('distribution/', [CrmLeadsController::class, 'DistributionIndex'])->name('filter');
    Route::post('add-to-user/', [CrmLeadsController::class, 'AddToUser'])->name('addToUser');
    Route::get('destroy/{id}', [CrmLeadsController::class, 'destroy'])->name('destroy');

    Route::get('report/', [CrmLeadsController::class, 'report'])->name('report');
    Route::post('report/', [CrmLeadsController::class, 'report'])->name('filterReport');

});










