<?php

use App\AppPlugin\Faq\FaqCategoryController;
use App\AppPlugin\Faq\FaqController;
use App\AppPlugin\Faq\FaqTagsController;
use Illuminate\Support\Facades\Route;


Route::get('/faq-category/',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.FaqCategory.index');
Route::get('/faq-category/Main',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.FaqCategory.index_Main');
Route::get('/faq-category/SubCategory/{id}',[FaqCategoryController::class,'CategoryIndex'])->name('Faq.FaqCategory.SubCategory');

Route::get('/faq-category/DataTable',[FaqCategoryController::class,'DataTable'])->name('Faq.FaqCategory.DataTable');
Route::get('/faq-category/create',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.FaqCategory.create');
Route::get('/faq-category/create/ar',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.FaqCategory.create_ar');
Route::get('/faq-category/create/en',[FaqCategoryController::class,'CategoryCreate'])->name('Faq.FaqCategory.create_en');
Route::get('/faq-category/edit/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.FaqCategory.edit');
Route::get('/faq-category/editAr/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.FaqCategory.editAr');
Route::get('/faq-category/editEn/{id}',[FaqCategoryController::class,'CategoryEdit'])->name('Faq.FaqCategory.editEn');
Route::get('/faq-category/emptyPhoto/{id}', [FaqCategoryController::class,'emptyPhoto'])->name('Faq.FaqCategory.emptyPhoto');
Route::get('/faq-category/DeleteLang/{id}',[FaqCategoryController::class,'DeleteLang'])->name('Faq.FaqCategory.DeleteLang');
Route::post('/faq-category/update/{id}',[FaqCategoryController::class,'CategoryStoreUpdate'])->name('Faq.FaqCategory.update');
Route::get('/faq-category/destroy/{id}',[FaqCategoryController::class,'destroyException'])->name('Faq.FaqCategory.destroy');
Route::get('/faq-category/config', [FaqCategoryController::class,'config'])->name('Faq.FaqCategory.config');
Route::get('/faq-category/emptyIcon/{id}', [FaqCategoryController::class,'emptyIcon'])->name('Faq.FaqCategory.emptyIcon');
Route::get('/faq-category/CatSort/{id}',[FaqCategoryController::class,'CategorySort'])->name('Faq.FaqCategory.CatSort');
Route::post('/faq-category/SaveSort',[FaqCategoryController::class,'CategorySaveSort'])->name('Faq.FaqCategory.SaveSort');


Route::get('/faq/',[FaqController::class,'PostIndex'])->name('Faq.Question.index');
Route::get('/faq/DataTable',[FaqController::class,'PostDataTable'])->name('Faq.Question.DataTable');
Route::get('/faq/Category/{Categoryid}',[FaqController::class,'PostListCategory'])->name('Faq.Question.ListCategory');
Route::get('/faq/SoftDelete/',[FaqController::class,'PostSoftDeletes'])->name('Faq.Question.SoftDelete');

Route::get('/faq/create',[FaqController::class,'PostCreate'])->name('Faq.Question.create');
Route::get('/faq/create/ar',[FaqController::class,'PostCreate'])->name('Faq.Question.create_ar');
Route::get('/faq/create/en',[FaqController::class,'PostCreate'])->name('Faq.Question.create_en');
Route::get('/faq/edit/{id}',[FaqController::class,'PostEdit'])->name('Faq.Question.edit');
Route::get('/faq/editAr/{id}',[FaqController::class,'PostEdit'])->name('Faq.Question.editAr');
Route::get('/faq/editEn/{id}',[FaqController::class,'PostEdit'])->name('Faq.Question.editEn');
Route::post('/faq/update/{id}',[FaqController::class,'PostStoreUpdate'])->name('Faq.Question.update');

Route::get('/faq/destroy/{id}',[FaqController::class,'destroy'])->name('Faq.Question.destroy');
Route::get('/faq/restore/{id}',[FaqController::class,'Restore'])->name('Faq.Question.restore');
Route::get('/faq/force/{id}',[FaqController::class,'PostForceDeleteException'])->name('Faq.Question.force');
Route::get('/faq/DeleteLang/{id}',[FaqController::class,'DeleteLang'])->name('Faq.Question.DeleteLang');
Route::get('/faq/emptyPhoto/{id}', [FaqController::class,'emptyPhoto'])->name('Faq.Question.emptyPhoto');

Route::get('/faq/photos/{id}',[FaqController::class,'ListMorePhoto'])->name('Faq.Question.More_Photos');
Route::post('/faq/AddMore',[FaqController::class,'AddMorePhotos'])->name('Faq.Question.More_PhotosAdd');
Route::post('/faq/saveSort', [FaqController::class,'sortPhotoSave'])->name('Faq.Question.sortPhotoSave');
Route::get('/faq/PhotoDel/{id}',[FaqController::class,'More_PhotosDestroy'])->name('Faq.Question.More_PhotosDestroy');
Route::get('/faq/PhotoEdit/{id}',[FaqController::class,'More_PhotosEdit'])->name('Faq.Question.More_PhotosEdit');
Route::post('/faq/PhotoUpdate/{id}',[FaqController::class,'More_PhotosUpdate'])->name('Faq.Question.More_PhotosUpdate');
Route::get('/faq/PhotosEdit/{id}',[FaqController::class,'More_PhotosEditAll'])->name('Faq.Question.More_PhotosEditAll');
Route::post('/faq/PhotoUpdateAll/{id}',[FaqController::class,'More_PhotosUpdateAll'])->name('Faq.Question.More_PhotosUpdateAll');
Route::get('/faq/config', [FaqController::class,'config'])->name('Faq.Question.config');


Route::get('/faq/tags', [FaqTagsController::class, 'TagsIndex'])->name('Faq.FaqTags.index');
Route::get('/faq/tags/DataTable', [FaqTagsController::class, 'TagsDataTable'])->name('Faq.FaqTags.DataTable');
Route::get('/faq/tags/create', [FaqTagsController::class, 'TagsCreate'])->name('Faq.FaqTags.create');
Route::get('/faq/tags/edit/{id}', [FaqTagsController::class, 'TagsEdit'])->name('Faq.FaqTags.edit');
Route::post('/faq/tags/update/{id}', [FaqTagsController::class, 'TagsStoreUpdate'])->name('Faq.FaqTags.update');
Route::get('/faq/tags/destroy/{id}', [FaqTagsController::class, 'TagsDelete'])->name('Faq.FaqTags.destroy');
Route::get('/faq/tags/config', [FaqTagsController::class, 'TagsConfig'])->name('Faq.FaqTags.config');
Route::get('/faq/tags/TagsSearch', [FaqTagsController::class, 'TagsSearch'])->name('FaqTags.TagsSearch');
Route::get('/faq/tags/TagsOnFly', [FaqTagsController::class, 'TagsOnFly'])->name('FaqTags.TagsOnFly');
