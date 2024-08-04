<?php


use App\AppPlugin\Crm\Tickets\CrmTicketFollowUpController;
use Illuminate\Support\Facades\Route;


Route::get('/follow/new', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.New');
Route::get('/follow/today', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.Today');
Route::get('/follow/back', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.Back');
Route::get('/follow/next', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.Next');
Route::get('follow/DataTable/{view}', [CrmTicketFollowUpController::class, 'DataTable'])->name('TicketFollowUp.DataTable');


Route::get('/follow/view-ticket/{id}', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.viewTicket');
Route::get('/follow/change-user/{id}', [CrmTicketFollowUpController::class, 'changeUser'])->name('TicketFollowUp.changeUser');
Route::post('/follow/change-user/{id}', [CrmTicketFollowUpController::class, 'changeUserUpdate'])->name('TicketFollowUp.changeUserUpdate');
Route::get('/follow/destroy-ticket/{id}', [CrmTicketFollowUpController::class, 'index'])->name('TicketFollowUp.destroy');

//Route::post('/crm/customers/', [CrmTicketsController::class, 'index'])->name('CrmCustomer.filter');





//Route::get('/crm/customers/create', [CrmTicketsController::class, 'create'])->name('CrmCustomer.create');
//Route::get('/crm/customers/addNew', [CrmTicketsController::class, 'create'])->name('CrmCustomer.addNew');

//Route::get('/crm/customers/profile/{id}', [CrmTicketsController::class, 'profile'])->name('CrmCustomer.profile');
//Route::get('/crm/customers/emptyPhoto/{id}', [CrmTicketsController::class, 'emptyPhoto'])->name('CrmCustomer.emptyPhoto');
//Route::post('/crm/customers/update/{id}', [CrmTicketsController::class, 'storeUpdate'])->name('CrmCustomer.update');
//Route::get('/crm/customers/destroy/{id}', [CrmTicketsController::class, 'ForceDeleteException'])->name('CrmCustomer.destroy');
//Route::get('/crm/customers/config', [CrmTicketsController::class, 'config'])->name('CrmCustomer.config');
//Route::get('/crm/customers/repeat/{num}', [CrmTicketsController::class, 'repeat'])->name('CrmCustomer.repeat');

//Route::get('/crm/customers/report/', [CrmTicketsController::class, 'report'])->name('CrmCustomer.Report.index');
//Route::post('/crm/customers/report/', [CrmTicketsController::class, 'report'])->name('CrmCustomer.Report.filter');

//Route::get('/crm/customers/search/', [CrmTicketsController::class, 'search'])->name('CrmCustomer.search');
//Route::post('/crm/customers/search/', [CrmTicketsController::class, 'searchFilter'])->name('CrmCustomer.searchFilter');

