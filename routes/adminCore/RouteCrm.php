<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/crm/leads.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/leads.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/ticket.php'));
}
if (File::isFile(base_path('routes/AppPlugin/crm/ticket_tech_follow.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/ticket_tech_follow.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/customers.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/ImportData.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/ImportData.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/Periodicals.php'));
}



