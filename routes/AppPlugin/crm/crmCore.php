<?php

use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketInfoController;
use Illuminate\Support\Facades\Route;

Route::get('crm/ticket-info/{id}', [CrmTicketInfoController::class, 'TicketInfo'])->name('CrmCore.TicketInfo');
Route::get('crm/change-user/{id}', [CrmTicketInfoController::class, 'ChangeUser'])->name('CrmCore.ChangeUser');


