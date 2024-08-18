<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {

    if (File::isFile(base_path('routes/AppPlugin/model/blogPost.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/model/blogPost.php'));
    }

}


if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/proProduct.php'));
}

if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/model/faq.php'));
}

if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/model/blog.php'));
}


if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/model/pages.php'));
}

if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/fileManager.php'));
}

if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/orders.php'));
}

if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/customer_admin.php'));
}
