<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/leads.php'));
}

if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket.php'));
}
if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_tech_follow.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket_tech_follow.php'));
}





