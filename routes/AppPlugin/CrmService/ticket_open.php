<?php


use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketOpenController;
use Illuminate\Support\Facades\Route;


Route::get('/ticket-open/new', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.New');
Route::get('/ticket-open/today', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.Today');
Route::get('/ticket-open/back', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.Back');
Route::get('/ticket-open/next', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.Next');
Route::get('ticket-open/DataTable/{view}', [CrmTicketOpenController::class, 'DataTable'])->name('TicketFollowUp.DataTable');


Route::get('/ticket-open/view-ticket/{ticketId}', [CrmTicketOpenController::class, 'viewTicket'])->name('TicketFollowUp.viewTicket');
Route::get('/ticket-open/change-user/{id}', [CrmTicketOpenController::class, 'changeUser'])->name('TicketFollowUp.changeUser');
Route::post('/ticket-open/change-user/{id}', [CrmTicketOpenController::class, 'changeUserUpdate'])->name('TicketFollowUp.changeUserUpdate');
Route::get('/ticket-open/destroy-ticket/{ticketId}', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.destroy');
