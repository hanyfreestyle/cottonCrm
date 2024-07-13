<?php


use App\AppPlugin\Crm\Periodicals\BookTagsController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsNotesController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsReleaseController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsReleaseReportController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsReportController;
use App\AppPlugin\Crm\Periodicals\ReleaseFilterController;
use Illuminate\Support\Facades\Route;


Route::get('/book/periodicals/', [PeriodicalsController::class, 'index'])->name('Periodicals.index');
Route::post('/book/periodicals/', [PeriodicalsController::class, 'index'])->name('Periodicals.filter');
Route::get('/book/periodicals/DataTable', [PeriodicalsController::class, 'DataTable'])->name('Periodicals.DataTable');
Route::get('/book/periodicals/create', [PeriodicalsController::class, 'create'])->name('Periodicals.create');
Route::get('/book/periodicals/edit/{id}', [PeriodicalsController::class, 'edit'])->name('Periodicals.edit');
Route::post('/book/periodicals/update/{id}', [PeriodicalsController::class, 'storeUpdate'])->name('Periodicals.update');
Route::get('/book/periodicals/destroy/{id}', [PeriodicalsController::class, 'ForceDeleteException'])->name('Periodicals.destroy');

Route::get('/book/release/{id}', [PeriodicalsReleaseController::class, 'ReleaseDataTable'])->name('PeriodicalsRelease.ReleaseDataTable');
Route::get('/book/release/list/{id}', [PeriodicalsReleaseController::class, 'ListRelease'])->name('Periodicals.ListRelease');
Route::get('/book/release/add/{id}', [PeriodicalsReleaseController::class, 'AddRelease'])->name('Periodicals.AddRelease');
Route::get('/book/release/edit/{id}', [PeriodicalsReleaseController::class, 'EditRelease'])->name('PeriodicalsRelease.edit');
Route::post('/book/AddOneRelease/{cat_id}', [PeriodicalsReleaseController::class, 'AddEditOneRelease'])->name('PeriodicalsRelease.AddEditOneRelease');
Route::get('/book/release/destroy/{id}', [PeriodicalsReleaseController::class, 'DeleteRelease'])->name('PeriodicalsRelease.destroy');
Route::get('/book/release/addYears/{id}', [PeriodicalsReleaseController::class, 'AddReleaseYears'])->name('Periodicals.AddReleaseYears');
Route::post('/book/release/addYears/Form/{cat_id}', [PeriodicalsReleaseController::class, 'AddYearReleaseForm'])->name('Periodicals.AddYearReleaseForm');
Route::get('/book/release/deleteAll/{id}', [PeriodicalsReleaseController::class, 'ReleaseDeleteAll'])->name('Periodicals.deleteAllRelease');
Route::post('/book/release/deleteAllConfirm/{id}', [PeriodicalsReleaseController::class, 'ReleaseDeleteAllConfirm'])->name('Periodicals.deleteAllReleaseConfirm');



Route::get('/book/periodicals/report/', [PeriodicalsReportController::class, 'report'])->name('Periodicals.Report.index');
Route::post('/book/periodicals/report/', [PeriodicalsReportController::class, 'report'])->name('Periodicals.Report.filter');
Route::get('/book/Periodicals/ReleaseReport/', [PeriodicalsReleaseReportController::class, 'report'])->name('Periodicals.ReleaseReport.index');
Route::post('/book/Periodicals/ReleaseReport/', [PeriodicalsReleaseReportController::class, 'report'])->name('Periodicals.ReleaseReport.filter');

Route::get('/book/release-filter/', [ReleaseFilterController::class, 'SelRelease'])->name('Periodicals.ReleaseFilter.index');
Route::post('/book/release-filter/', [ReleaseFilterController::class, 'SelRelease'])->name('Periodicals.ReleaseFilter.filter');

Route::get('/book/notes/', [PeriodicalsNotesController::class, 'index'])->name('Periodicals.Notes.index');
Route::post('/book/notes/', [PeriodicalsNotesController::class, 'index'])->name('Periodicals.Notes.filter');
Route::get('/book/notes/DataTable', [PeriodicalsNotesController::class, 'DataTable'])->name('Periodicals.Notes.DataTable');
Route::get('/book/notes/config', [PeriodicalsNotesController::class, 'config'])->name('Periodicals.Notes.config');
Route::get('/book/notes/create/{id}', [PeriodicalsNotesController::class, 'NotesCreate'])->name('Periodicals.Notes.create');
Route::get('/book/notes/edit/{id}', [PeriodicalsNotesController::class, 'NotesEdit'])->name('Periodicals.Notes.edit');
Route::post('/book/notes/update/{id}', [PeriodicalsNotesController::class, 'NotesStoreUpdate'])->name('Periodicals.Notes.update');
Route::get('/book/notes/destroy/{id}', [PeriodicalsNotesController::class, 'DeleteNotes'])->name('Periodicals.Notes.destroy');


Route::get('/book/tags', [BookTagsController::class, 'TagsIndex'])->name('Periodicals.BookTags.index');
Route::get('/book/tags/DataTable', [BookTagsController::class, 'TagsDataTable'])->name('Periodicals.BookTags.DataTable');
Route::get('/book/tags/create', [BookTagsController::class, 'TagsCreate'])->name('Periodicals.BookTags.create');
Route::get('/book/tags/edit/{id}', [BookTagsController::class, 'TagsEdit'])->name('Periodicals.BookTags.edit');
Route::post('/book/tags/update/{id}', [BookTagsController::class, 'TagsStoreUpdate'])->name('Periodicals.BookTags.update');
Route::get('/book/tags/destroy/{id}', [BookTagsController::class, 'TagsDelete'])->name('Periodicals.BookTags.destroy');

Route::get('/book/tags/TagsSearch', [BookTagsController::class, 'TagsSearch'])->name('Periodicals.TagsSearch');
Route::get('/book/tags/TagsOnFly', [BookTagsController::class, 'TagsOnFly'])->name('Periodicals.TagsOnFly');

