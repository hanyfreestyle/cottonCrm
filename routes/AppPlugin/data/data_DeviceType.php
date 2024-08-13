<?php


use App\AppPlugin\Data\DataDeviceType\DataDeviceTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/device-type/',[DataDeviceTypeController::class,'indexData'])->name('data.DeviceType.index');
Route::get('/device-type/archived',[DataDeviceTypeController::class,'indexData'])->name('data.DeviceType.archived');
Route::get('/device-type/DataTable',[DataDeviceTypeController::class,'DataTable'])->name('data.DeviceType.DataTable');
Route::get('/device-type/DataTable/archived',[DataDeviceTypeController::class,'DataTableArchived'])->name('data.DeviceType.DataTableArchived');
Route::get('/device-type/create',[DataDeviceTypeController::class,'createData'])->name('data.DeviceType.create');
Route::get('/device-type/edit/{id}',[DataDeviceTypeController::class,'editData'])->name('data.DeviceType.edit');
Route::post('/device-type/update/{id}',[DataDeviceTypeController::class,'storeUpdateData'])->name('data.DeviceType.update');
Route::get('/device-type/destroy/{id}',[DataDeviceTypeController::class,'ForceDeleteException'])->name('data.DeviceType.destroy');
Route::get('/device-type/config', [DataDeviceTypeController::class,'configData'])->name('data.DeviceType.config');
