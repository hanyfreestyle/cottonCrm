<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/leads.php'));
}

if (File::isFile(base_path('routes/AppPlugin/CrmService/follow_up.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/follow_up.php'));
}

if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/CrmService/ticket_open.php'));
}




