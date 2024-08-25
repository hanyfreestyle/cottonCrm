<?php

use App\AppPlugin\Crm\CrmService\FollowUp\UserFollowUpController;
use Illuminate\Support\Facades\Route;


Route::get('/follow-up/new', [UserFollowUpController::class, 'index'])->name('TechFollowUp.New');
Route::get('/follow-up/today', [UserFollowUpController::class, 'index'])->name('TechFollowUp.Today');
Route::get('/follow-up/back', [UserFollowUpController::class, 'index'])->name('TechFollowUp.Back');
Route::get('/follow-up/next', [UserFollowUpController::class, 'index'])->name('TechFollowUp.Next');
Route::get('/follow-up/report', [UserFollowUpController::class, 'Report'])->name('TechFollowUp.Report');

Route::get('/follow-up/update-ticket/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('TechFollowUp.UpdateTicket');


