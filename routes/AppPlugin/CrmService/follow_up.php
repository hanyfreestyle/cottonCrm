<?php

use App\AppPlugin\Crm\CrmService\FollowUp\UserFollowUpController;
use Illuminate\Support\Facades\Route;


Route::prefix('/follow-up')->name('TechFollowUp.')->group(function () {
    Route::get('/new', [UserFollowUpController::class, 'index'])->name('New');
    Route::get('/today', [UserFollowUpController::class, 'index'])->name('Today');
    Route::get('/back', [UserFollowUpController::class, 'index'])->name('Back');
    Route::get('/next', [UserFollowUpController::class, 'index'])->name('Next');
    Route::get('/report/', [UserFollowUpController::class, 'Report'])->name('Report');
    Route::get('/amount/', [UserFollowUpController::class, 'AmountList'])->name('AmountList');
    Route::get('/update-ticket/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdateTicket');
    Route::post('/update-status/{ticketId}', [UserFollowUpController::class, 'UpdateTicketStatus'])->name('UpdateTicketStatus');

    Route::get('/update-finished/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdateFinished');
    Route::get('/update-depends/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdateDepends');
    Route::get('/update-postponed/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdatePostponed');
    Route::get('/update-cancellation/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdateCancellation');
    Route::get('/update-reject/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdateReject');
});

