<?php

use App\AppPlugin\Crm\TicketsTechFollow\CrmTicketTechFollowController;
use Illuminate\Support\Facades\Route;


Route::get('/follow-up/new', [CrmTicketTechFollowController::class, 'index'])->name('TechFollowUp.New');
Route::get('/follow-up/today', [CrmTicketTechFollowController::class, 'index'])->name('TechFollowUp.Today');
Route::get('/follow-up/back', [CrmTicketTechFollowController::class, 'index'])->name('TechFollowUp.Back');
Route::get('/follow-up/next', [CrmTicketTechFollowController::class, 'index'])->name('TechFollowUp.Next');
Route::get('/follow-up/report', [CrmTicketTechFollowController::class, 'Report'])->name('TechFollowUp.Report');
Route::get('/tech/view-ticket/{id}', [CrmTicketTechFollowController::class, 'ViewTicket'])->name('TechFollowUp.ViewTicket');

