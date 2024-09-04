<?php

use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketOpenController;
use Illuminate\Support\Facades\Route;

Route::prefix('/ticket-open/')->name('TicketOpen.')->group(function () {
    Route::get('all', [CrmTicketOpenController::class, 'index'])->name('All');
    Route::post('all', [CrmTicketOpenController::class, 'index'])->name('filter');
    Route::get('new', [CrmTicketOpenController::class, 'index'])->name('New');
    Route::get('today', [CrmTicketOpenController::class, 'index'])->name('Today');
    Route::get('back', [CrmTicketOpenController::class, 'index'])->name('Back');
    Route::get('next', [CrmTicketOpenController::class, 'index'])->name('Next');
    Route::get('DataTable/{view}', [CrmTicketOpenController::class, 'DataTable'])->name('DataTable');

    Route::get('report/', [CrmTicketOpenController::class, 'report'])->name('Report');
    Route::post('report/', [CrmTicketOpenController::class, 'report'])->name('filterReport');
    Route::get('config/', [CrmTicketOpenController::class, 'config'])->name('config');


});

Route::prefix('/ticket-open/')->name('TicketOpen.')->group(function () {
    Route::get('view-ticket/{ticketId}', [CrmTicketOpenController::class, 'viewTicket'])->name('viewTicket');
    Route::get('change-user/{id}', [CrmTicketOpenController::class, 'changeUser'])->name('changeUser');
    Route::post('change-user/{id}', [CrmTicketOpenController::class, 'changeUserUpdate'])->name('changeUserUpdate');
    Route::get('destroy-ticket/{ticketId}', [CrmTicketOpenController::class, 'destroy'])->name('destroy');
});
