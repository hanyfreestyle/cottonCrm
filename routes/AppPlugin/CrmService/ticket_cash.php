<?php

use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketCashController;

use Illuminate\Support\Facades\Route;

Route::prefix('/ticket-cash/')->name('TicketCash.')->group(function () {


    Route::get('all', [CrmTicketCashController::class, 'index'])->name('All');
    Route::post('all', [CrmTicketCashController::class, 'index'])->name('filter');
    Route::get('cost', [CrmTicketCashController::class, 'index'])->name('Cost');
    Route::get('deposit', [CrmTicketCashController::class, 'index'])->name('Deposit');
    Route::get('service', [CrmTicketCashController::class, 'index'])->name('Service');


    Route::get('report/', [CrmTicketCashController::class, 'report'])->name('Report');
    Route::post('report/', [CrmTicketCashController::class, 'report'])->name('filterReport');
    Route::get('config/', [CrmTicketCashController::class, 'config'])->name('config');
});


