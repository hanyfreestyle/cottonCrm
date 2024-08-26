<?php

use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketClosedController;
use Illuminate\Support\Facades\Route;

Route::prefix('/ticket-close/')->name('TicketClose.')->group(function () {
    Route::get('Finished', [CrmTicketClosedController::class, 'index'])->name('Finished');
    Route::get('Reject', [CrmTicketClosedController::class, 'index'])->name('Reject');
    Route::get('Cancellation', [CrmTicketClosedController::class, 'index'])->name('Cancellation');
//    Route::post('all', [CrmTicketOpenController::class, 'index'])->name('filter');

    Route::get('DataTable/{view}', [CrmTicketClosedController::class, 'DataTable'])->name('DataTable');

    Route::get('report/', [CrmTicketClosedController::class, 'report'])->name('Report');
    Route::post('report/', [CrmTicketClosedController::class, 'report'])->name('filterReport');
    Route::get('config/', [CrmTicketClosedController::class, 'config'])->name('config');

    Route::get('view-ticket/{ticketId}', [CrmTicketClosedController::class, 'viewTicket'])->name('viewTicket');
    Route::get('destroy-ticket/{ticketId}', [CrmTicketClosedController::class, 'destroy'])->name('destroy');
});


