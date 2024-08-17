<?php
use App\AppPlugin\Pages\PageCategoryController;
use App\AppPlugin\Pages\PageController;
use App\AppPlugin\Pages\PageTagsController;
use Illuminate\Support\Facades\Route;


Route::get('/page-category/',[PageCategoryController::class,'CategoryIndex'])->name('Pages.PageCategory.index');
Route::get('/page-category/main',[PageCategoryController::class,'CategoryIndex'])->name('Pages.PageCategory.index_Main');
Route::get('/page-category/sub-category/{id}',[PageCategoryController::class,'CategoryIndex'])->name('Pages.PageCategory.SubCategory');

Route::get('/page-category/DataTable/all',[PageCategoryController::class,'DataTable'])->name('Pages.PageCategory.DataTable');
Route::get('/page-category/DataTable/main',[PageCategoryController::class,'DataTableMain'])->name('Pages.PageCategory.DataTableMain');
Route::get('/page-category/DataTable/sub/{id}',[PageCategoryController::class,'DataTableSub'])->name('Pages.PageCategory.DataTableSub');


Route::get('/page-category/create',[PageCategoryController::class,'CategoryCreate'])->name('Pages.PageCategory.create');
Route::get('/page-category/create/ar',[PageCategoryController::class,'CategoryCreate'])->name('Pages.PageCategory.create_ar');
Route::get('/page-category/create/en',[PageCategoryController::class,'CategoryCreate'])->name('Pages.PageCategory.create_en');
Route::get('/page-category/edit/{id}',[PageCategoryController::class,'CategoryEdit'])->name('Pages.PageCategory.edit');
Route::get('/page-category/editAr/{id}',[PageCategoryController::class,'CategoryEdit'])->name('Pages.PageCategory.editAr');
Route::get('/page-category/editEn/{id}',[PageCategoryController::class,'CategoryEdit'])->name('Pages.PageCategory.editEn');
Route::get('/page-category/emptyPhoto/{id}', [PageCategoryController::class,'emptyPhoto'])->name('Pages.PageCategory.emptyPhoto');
Route::get('/page-category/DeleteLang/{id}',[PageCategoryController::class,'DeleteLang'])->name('Pages.PageCategory.DeleteLang');
Route::post('/page-category/update/{id}',[PageCategoryController::class,'CategoryStoreUpdate'])->name('Pages.PageCategory.update');
Route::get('/page-category/destroy/{id}',[PageCategoryController::class,'destroyException'])->name('Pages.PageCategory.destroy');
Route::get('/page-category/destroyEdit/{id}',[PageCategoryController::class,'destroyException'])->name('Pages.PageCategory.destroyEdit');

Route::get('/page-category/config', [PageCategoryController::class,'CategoryConfig'])->name('Pages.PageCategory.config');
Route::get('/page-category/emptyIcon/{id}', [PageCategoryController::class,'emptyIcon'])->name('Pages.PageCategory.emptyIcon');
Route::get('/page-category/sort/{id}',[PageCategoryController::class,'CategorySort'])->name('Pages.PageCategory.CatSort');
Route::post('/page-category/save-sort',[PageCategoryController::class,'CategorySaveSort'])->name('Pages.PageCategory.SaveSort');



Route::get('/pages/',[PageController::class,'PostIndex'])->name('Pages.PageList.index');
Route::get('/pages/DataTable/',[PageController::class,'PostDataTable'])->name('Pages.PageList.DataTable');
Route::get('/pages/category/{categoryId}',[PageController::class,'PostListCategory'])->name('Pages.PageList.FilterCategory');
Route::get('/pages/category/DataTable/{categoryId}',[PageController::class,'PostDataTableCategory'])->name('Pages.PageList.DataTableCategory');

Route::get('/pages/soft-delete/',[PageController::class,'PostSoftDeletes'])->name('Pages.PageList.SoftDelete');
Route::get('/pages/soft-delete/DataTable/',[PageController::class,'PostDataTableSoftDeletes'])->name('Pages.PageList.DataTableSoftDeletes');

Route::get('/pages/create/new',[PageController::class,'PostCreate'])->name('Pages.PageList.createNew');
Route::get('/pages/create',[PageController::class,'PostCreate'])->name('Pages.PageList.create');
Route::get('/pages/create/ar',[PageController::class,'PostCreate'])->name('Pages.PageList.create_ar');
Route::get('/pages/create/en',[PageController::class,'PostCreate'])->name('Pages.PageList.create_en');
Route::get('/pages/edit/{id}',[PageController::class,'PostEdit'])->name('Pages.PageList.edit');
Route::get('/pages/editAr/{id}',[PageController::class,'PostEdit'])->name('Pages.PageList.editAr');
Route::get('/pages/editEn/{id}',[PageController::class,'PostEdit'])->name('Pages.PageList.editEn');
Route::post('/pages/update/{id}',[PageController::class,'PostStoreUpdate'])->name('Pages.PageList.update');

Route::get('/pages/destroy/{id}',[PageController::class,'destroy'])->name('Pages.PageList.destroy');
Route::get('/pages/destroy-edit/{id}',[PageController::class,'destroyEdit'])->name('Pages.PageList.destroyEdit');
Route::get('/pages/restore/{id}',[PageController::class,'Restore'])->name('Pages.PageList.restore');
Route::get('/pages/force/{id}',[PageController::class,'PostForceDeleteException'])->name('Pages.PageList.force');
Route::get('/pages/DeleteLang/{id}',[PageController::class,'DeleteLang'])->name('Pages.PageList.DeleteLang');
Route::get('/pages/emptyPhoto/{id}', [PageController::class,'emptyPhoto'])->name('Pages.PageList.emptyPhoto');

Route::get('/pages/photos/{id}',[PageController::class,'ListMorePhoto'])->name('Pages.PageList.More_Photos');
Route::post('/pages/add-more',[PageController::class,'AddMorePhotos'])->name('Pages.PageList.More_PhotosAdd');
Route::post('/pages/saveSort', [PageController::class,'sortPhotoSave'])->name('Pages.PageList.sortPhotoSave');
Route::get('/pages/photo/delete/{id}',[PageController::class,'MorePhotosDestroy'])->name('Pages.PageList.More_PhotosDestroy');
Route::get('/pages/photo/delete-all/{postid}',[PageController::class,'MorePhotosDestroyAll'])->name('Pages.PageList.More_PhotosDestroyAll');
Route::get('/pages/photo-edit/{id}',[PageController::class,'MorePhotosEdit'])->name('Pages.PageList.More_PhotosEdit');
Route::post('/pages/photo-update/{id}',[PageController::class,'MorePhotosUpdate'])->name('Pages.PageList.More_PhotosUpdate');
Route::get('/pages/photos-edit/{id}',[PageController::class,'MorePhotosEditAll'])->name('Pages.PageList.More_PhotosEditAll');
Route::post('/pages/photo-update-all/{id}',[PageController::class,'MorePhotosUpdateAll'])->name('Pages.PageList.More_PhotosUpdateAll');
Route::get('/pages/config', [PageController::class,'config'])->name('Pages.PageList.config');


Route::get('/pages/tags', [PageTagsController::class, 'TagsIndex'])->name('Pages.PageTags.index');
Route::get('/pages/tags/DataTable', [PageTagsController::class, 'TagsDataTable'])->name('Pages.PageTags.DataTable');
Route::get('/pages/tags/create', [PageTagsController::class, 'TagsCreate'])->name('Pages.PageTags.create');
Route::get('/pages/tags/edit/{id}', [PageTagsController::class, 'TagsEdit'])->name('Pages.PageTags.edit');
Route::post('/pages/tags/update/{id}', [PageTagsController::class, 'TagsStoreUpdate'])->name('Pages.PageTags.update');
Route::get('/pages/tags/destroy/{id}', [PageTagsController::class, 'TagsDelete'])->name('Pages.PageTags.destroy');
Route::get('/pages/tags/config', [PageTagsController::class, 'TagsConfig'])->name('Pages.PageTags.config');
Route::get('/pages/tags/TagsSearch', [PageTagsController::class, 'TagsSearch'])->name('PageTags.TagsSearch');
Route::get('/pages/tags/TagsOnFly', [PageTagsController::class, 'TagsOnFly'])->name('PageTags.TagsOnFly');

