<?php

use App\AppPlugin\Product\AttributeController;
use App\AppPlugin\Product\AttributeValueController;
use App\AppPlugin\Product\ManageAttributeController;
use App\AppPlugin\Product\ProductBrandController;
use App\AppPlugin\Product\ProductCategoryController;
use App\AppPlugin\Product\ProductController;
use App\AppPlugin\Product\ProductDashboardController;
use App\AppPlugin\Product\ProductLandingController;
use App\AppPlugin\Product\ProductTagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductDashboardController::class, 'Dashboard'])->name('Dashboard');
Route::get('/product/update-prices', [ProductController::class, 'UpdatePrices'])->name('Shop.UpdatePrices.index');


Route::CategoryRoute('product/category', 'Product.Category.', ProductCategoryController::class);
Route::CategoryRoute('product/brand/', 'Product.Brand.', ProductBrandController::class);
Route::TagsRoutes('product/tags/', 'Product.ProductTags.', 'ProductTags.', ProductTagsController::class);


Route::get('/product/', [ProductController::class, 'ProductIndex'])->name('Product.Product.index');
Route::post('/product/', [ProductController::class, 'ProductIndex'])->name('Product.Product.filter');
Route::get('/product/DataTable', [ProductController::class, 'ProductDataTable'])->name('Product.Product.DataTable');

Route::get('/product/achived', [ProductController::class, 'ProductIndex'])->name('Product.ProductAchived.index');
Route::post('/product/achived', [ProductController::class, 'ProductIndex'])->name('Product.Product.filter_archived');
Route::get('/product/DataTableArchived', [ProductController::class, 'DataTableArchived'])->name('Product.Product.DataTableArchived');

Route::get('/product/SoftDelete/', [ProductController::class, 'ProductIndex'])->name('Product.Product.SoftDelete');
Route::get('/product/DataTableSoftDelete/', [ProductController::class, 'DataTableSoftDelete'])->name('Product.Product.DataTableSoftDelete');

Route::get('/product/create', [ProductController::class, 'create'])->name('Product.Product.create');
Route::get('/product/create/ar', [ProductController::class, 'create'])->name('Product.Product.create_ar');
Route::get('/product/create/en', [ProductController::class, 'create'])->name('Product.Product.create_en');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('Product.Product.edit');
Route::get('/product/editAr/{id}', [ProductController::class, 'edit'])->name('Product.Product.editAr');
Route::get('/product/editEn/{id}', [ProductController::class, 'edit'])->name('Product.Product.editEn');
Route::post('/product/update/{id}', [ProductController::class, 'storeUpdate'])->name('Product.Product.update');

Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('Product.Product.destroy');
Route::get('/product/restore/{id}', [ProductController::class, 'Restore'])->name('Product.Product.restore');
Route::get('/product/force/{id}', [ProductController::class, 'ForceDeleteException'])->name('Product.Product.force');
Route::get('/product/DeleteLang/{id}', [ProductController::class, 'DeleteLang'])->name('Product.Product.DeleteLang');
Route::get('/product/emptyPhoto/{id}', [ProductController::class, 'emptyPhoto'])->name('Product.Product.emptyPhoto');

Route::get('/product/photos/{id}', [ProductController::class, 'ListMorePhoto'])->name('Product.Product.More_Photos');
Route::post('/product/AddMore', [ProductController::class, 'AddMorePhotos'])->name('Product.Product.More_PhotosAdd');
Route::post('/product/saveSort', [ProductController::class, 'sortPhotoSave'])->name('Product.Product.sortPhotoSave');
Route::get('/product/PhotoDel/{id}', [ProductController::class, 'More_PhotosDestroy'])->name('Product.Product.More_PhotosDestroy');
Route::get('/product/config', [ProductController::class, 'config'])->name('Product.Product.config');


Route::prefix('product/attribute')->name('Product.ProAttribute.')
    ->controller(AttributeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'storeUpdate')->name('update');
        Route::get('/destroy/{id}', 'ForceDeleteException')->name('destroy');
        Route::get('/sort', 'Sort')->name('Sort');
        Route::post('/save-sort', 'SaveSort')->name('SaveSort');
        Route::get('/config', 'config')->name('config');
    });

Route::prefix('product/att/value')->name('Product.ProAttributeValue.')
    ->controller(AttributeValueController::class)->group(function () {
        Route::get('/{AttributeId}', 'index')->name('index');
        Route::get('/create/{AttributeId}', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'storeUpdate')->name('update');
        Route::get('/destroy/{id}', 'ForceDeleteException')->name('destroy');
        Route::get('/sort/{AttributeId}', 'Sort')->name('Sort');
        Route::post('/save-sort', 'SaveSort')->name('SaveSort');
        Route::get('/config/{AttributeId}', 'config')->name('config');
    });

//Route::get('/attribute/value/{AttributeId}', [AttributeValueController::class, 'index'])->name('Shop.ProAttributeValue.index');
//Route::get('/attribute/value/create/{AttributeId}', [AttributeValueController::class, 'create'])->name('Shop.ProAttributeValue.create');
//Route::get('/attribute/value/edit/{id}', [AttributeValueController::class, 'edit'])->name('Shop.ProAttributeValue.edit');
//Route::post('/attribute/value/update/{id}', [AttributeValueController::class, 'storeUpdate'])->name('Shop.ProAttributeValue.update');
//Route::get('/attribute/value/destroy/{id}', [AttributeValueController::class, 'ForceDeleteException'])->name('Shop.ProAttributeValue.destroy');
//Route::get('/attribute/value/Sort/{AttributeId}', [AttributeValueController::class, 'Sort'])->name('Shop.ProAttributeValue.Sort');
//Route::post('/attribute/value/SaveSort', [AttributeValueController::class, 'SaveSort'])->name('Shop.ProAttributeValue.SaveSort');
//Route::get('/attribute/value/config/{AttributeId}', [AttributeValueController::class, 'config'])->name('Shop.ProAttributeValue.config');

Route::get('/product/manage-attribute/{id}', [ManageAttributeController::class, 'ManageAttribute'])->name('Product.Product.manage-attribute');
Route::post('/product/manage-attribute-update/{id}', [ManageAttributeController::class, 'ManageAttributeUpdate'])->name('Product.Product.manage-attributeUpdate');
Route::get('/product/remove-attribute/{proId}/{AttributeId}', [ManageAttributeController::class, 'RemoveAttribute'])->name('Product.Product.remove-attribute');

Route::post('/product/attribute-value-update', [ManageAttributeController::class, 'ManageAttributeValueUpdate'])->name('Product.Product.value-update');
Route::post('/product/UpdateVariants/{proId}', [ManageAttributeController::class, 'UpdateVariants'])->name('Product.Product.UpdateVariants');
Route::get('/product/remove-variants/{proId}', [ManageAttributeController::class, 'RemoveVariants'])->name('Product.Product.RemoveVariants');


Route::prefix('product/lp/')->name('LandingPage.')
    ->controller(ProductLandingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/DataTable', 'DataTable')->name('DataTable');
        Route::get('/create', 'PageCreate')->name('create');
        Route::get('/add-new', 'PageCreate')->name('AddNew');
        Route::get('/edit/{id}', 'PageEdit')->name('edit');
        Route::post('/update/{id}', 'PageStoreUpdate')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/emptyPhoto/{id}', 'emptyPhoto')->name('emptyPhoto');
        Route::get('/config', 'config')->name('config');
    });



