<?php

use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketCashController;

use Illuminate\Support\Facades\Route;

Route::prefix('/ticket-cash/')->name('TicketCash.')->group(function () {

    Route::get('cost', [CrmTicketCashController::class, 'index'])->name('Cost');
    Route::get('deposit', [CrmTicketCashController::class, 'index'])->name('Deposit');
    Route::get('service', [CrmTicketCashController::class, 'index'])->name('Service');
    Route::get('cash-back', [CrmTicketCashController::class, 'indexCashBack'])->name('CashBack');

    Route::get('confirm-pay/{id}', [CrmTicketCashController::class, 'ConfirmPay'])->name('ConfirmPay');
    Route::get('confirm-pay-back/{id}', [CrmTicketCashController::class, 'ConfirmPayBack'])->name('ConfirmPayBack');
    Route::get('cash-list', [CrmTicketCashController::class, 'CashList'])->name('CashList');
    Route::post('cash-list', [CrmTicketCashController::class, 'CashList'])->name('filter');
    Route::get('destroy/{id}', [CrmTicketCashController::class, 'DestroyPayment'])->name('destroy');


    Route::get('report/', [CrmTicketCashController::class, 'report'])->name('Report');
    Route::post('report/', [CrmTicketCashController::class, 'report'])->name('filterReport');

    Route::get('config/', [CrmTicketCashController::class, 'config'])->name('config');
});


