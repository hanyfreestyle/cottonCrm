<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HooverDataController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::get('/change-collapse', [DashboardController::class, 'ChangeCollapse'])->name('ChangeCollapse');


if (File::isFile(base_path('app\AppPlugin\Crm\Periodicals\BookDashboardController.php'))) {

}elseif (File::isFile(base_path('app\AppPlugin\Product\ProductDashboardController.php'))){

} else {
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('Dashboard');
}

Route::get('/testpdf', [DashboardController::class, 'testpdf'])->name('testpdf');

Route::get('/getConfigData', [HooverDataController::class, 'getConfigData'])->name('getConfigData');
Route::get('/getCustomerData', [HooverDataController::class, 'getCustomerData'])->name('getCustomerData');
Route::get('/syncCity', [HooverDataController::class, 'syncCity'])->name('syncCity');
Route::get('/UpdateNames', [HooverDataController::class, 'UpdateNames'])->name('UpdateNames');
Route::get('/getTicket', [HooverDataController::class, 'getTicket'])->name('getTicket');
Route::get('/syncTicketData', [HooverDataController::class, 'syncTicketData'])->name('syncTicketData');
Route::get('/CheckPriceWithClosed', [HooverDataController::class, 'CheckPriceWithClosed'])->name('CheckPriceWithClosed');
Route::get('/UpdateCancellation', [HooverDataController::class, 'UpdateCancellation'])->name('UpdateCancellation');
Route::get('/UpdateReject', [HooverDataController::class, 'UpdateReject'])->name('UpdateReject');
Route::get('/UpdateFinished', [HooverDataController::class, 'UpdateFinished'])->name('UpdateFinished');
Route::get('/UpdateTicketUUid', [HooverDataController::class, 'UpdateTicketUUid'])->name('UpdateTicketUUid');
Route::get('/UpdateCustomerUUid', [HooverDataController::class, 'UpdateCustomerUUid'])->name('UpdateCustomerUUid');
Route::get('/UpdateCustomerTypes', [HooverDataController::class, 'UpdateCustomerTypes'])->name('UpdateCustomerTypes');










