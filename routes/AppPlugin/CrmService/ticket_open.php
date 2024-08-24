<?php


use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketOpenController;
use Illuminate\Support\Facades\Route;

Route::get('/ticket-open/all', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.All');
Route::post('/ticket-open/all', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.filter');
Route::get('/ticket-open/new', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.New');
Route::get('/ticket-open/today', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.Today');
Route::get('/ticket-open/back', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.Back');
Route::get('/ticket-open/next', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.Next');
Route::get('ticket-open/DataTable/{view}', [CrmTicketOpenController::class, 'DataTable'])->name('TicketOpen.DataTable');


Route::get('/ticket-open/view-ticket/{ticketId}', [CrmTicketOpenController::class, 'viewTicket'])->name('TicketOpen.viewTicket');
Route::get('/ticket-open/change-user/{id}', [CrmTicketOpenController::class, 'changeUser'])->name('TicketOpen.changeUser');
Route::post('/ticket-open/change-user/{id}', [CrmTicketOpenController::class, 'changeUserUpdate'])->name('TicketOpen.changeUserUpdate');
Route::get('/ticket-open/destroy-ticket/{ticketId}', [CrmTicketOpenController::class, 'index'])->name('TicketOpen.destroy');

Route::get('/ticket-open/report/', [CrmTicketOpenController::class, 'report'])->name('TicketOpen.Report');
Route::post('/ticket-open/report/', [CrmTicketOpenController::class, 'report'])->name('TicketOpen.filterReport');
