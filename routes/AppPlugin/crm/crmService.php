<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/crm/crmCore.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/crmCore.php'));
}
if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/leads.php'));
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/follow_up.php'));
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket_open.php'));
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket_close.php'));
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket_cash.php'));
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket_review.php'));
}







