<?php

use App\AppPlugin\Crm\CrmService\FollowUp\UserFollowUpController;
use Illuminate\Support\Facades\Route;


Route::prefix('/follow-up')->name('TechFollowUp.')->group(function () {
    Route::get('/new', [UserFollowUpController::class, 'index'])->name('New');
    Route::get('/today', [UserFollowUpController::class, 'index'])->name('Today');
    Route::get('/back', [UserFollowUpController::class, 'index'])->name('Back');
    Route::get('/next', [UserFollowUpController::class, 'index'])->name('Next');
    Route::get('/report/', [UserFollowUpController::class, 'Report'])->name('Report');
    Route::get('/update-ticket/{ticketId}', [UserFollowUpController::class, 'UpdateTicket'])->name('UpdateTicket');
});

