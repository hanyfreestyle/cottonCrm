<?php


use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketOpenController;
use Illuminate\Support\Facades\Route;


Route::get('/follow/new', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.New');
Route::get('/follow/today', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.Today');
Route::get('/follow/back', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.Back');
Route::get('/follow/next', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.Next');
Route::get('follow/DataTable/{view}', [CrmTicketOpenController::class, 'DataTable'])->name('TicketFollowUp.DataTable');


Route::get('/follow/view-ticket/{ticketId}', [CrmTicketOpenController::class, 'viewTicket'])->name('TicketFollowUp.viewTicket');
Route::get('/follow/change-user/{id}', [CrmTicketOpenController::class, 'changeUser'])->name('TicketFollowUp.changeUser');
Route::post('/follow/change-user/{id}', [CrmTicketOpenController::class, 'changeUserUpdate'])->name('TicketFollowUp.changeUserUpdate');
Route::get('/follow/destroy-ticket/{ticketId}', [CrmTicketOpenController::class, 'index'])->name('TicketFollowUp.destroy');
