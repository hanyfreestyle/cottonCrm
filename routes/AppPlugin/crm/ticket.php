<?php


use App\AppPlugin\Crm\Tickets\CrmTicketFollowUpController;
use Illuminate\Support\Facades\Route;


Route::get('/follow/new', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.New');
Route::get('/follow/today', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.Today');
Route::get('/follow/back', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.Back');
Route::get('/follow/next', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.Next');
Route::get('follow/DataTable/{view}', [CrmTicketFollowUpController::class, 'DataTable'])->name('TicketFollowUp.DataTable');


Route::get('/follow/view-ticket/{ticketId}', [CrmTicketFollowUpController::class, 'viewTicket'])->name('TicketFollowUp.viewTicket');
Route::get('/follow/change-user/{id}', [CrmTicketFollowUpController::class, 'changeUser'])->name('TicketFollowUp.changeUser');
Route::post('/follow/change-user/{id}', [CrmTicketFollowUpController::class, 'changeUserUpdate'])->name('TicketFollowUp.changeUserUpdate');
Route::get('/follow/destroy-ticket/{ticketId}', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.destroy');
