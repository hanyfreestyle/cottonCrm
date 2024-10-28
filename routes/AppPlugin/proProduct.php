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

Route::CategoryRoute('product/category', 'Product.Category.', ProductCategoryController::class);
Route::CategoryRoute('product/brand/', 'Product.Brand.', ProductBrandController::class);
Route::TagsRoutes('product/tags/', 'Product.ProductTags.', 'ProductTags.', ProductTagsController::class);


//Route::get('/product/tags', [ProductTagsController::class, 'TagsIndex'])->name('Shop.ProductTags.index');
//Route::get('/product/tags/DataTable', [ProductTagsController::class, 'TagsDataTable'])->name('Shop.ProductTags.DataTable');
//Route::get('/product/tags/create', [ProductTagsController::class, 'TagsCreate'])->name('Shop.ProductTags.create');
//Route::get('/product/tags/edit/{id}', [ProductTagsController::class, 'TagsEdit'])->name('Shop.ProductTags.edit');
//Route::post('/product/tags/update/{id}', [ProductTagsController::class, 'TagsStoreUpdate'])->name('Shop.ProductTags.update');
//Route::get('/product/tags/destroy/{id}', [ProductTagsController::class, 'TagsDelete'])->name('Shop.ProductTags.destroy');
//Route::get('/product/tags/config', [ProductTagsController::class, 'TagsConfig'])->name('Shop.ProductTags.config');
//Route::get('/product/tags/TagsSearch', [ProductTagsController::class, 'TagsSearch'])->name('Product.TagsSearch');
//Route::get('/product/tags/TagsOnFly', [ProductTagsController::class, 'TagsOnFly'])->name('Product.TagsOnFly');


Route::get('/product/update-prices', [ProductController::class, 'UpdatePrices'])->name('Shop.UpdatePrices.index');

Route::get('/product/', [ProductController::class, 'ProductIndex'])->name('Shop.Product.index');
Route::post('/product/', [ProductController::class, 'ProductIndex'])->name('Shop.Product.filter');
Route::get('/product/DataTable', [ProductController::class, 'ProductDataTable'])->name('Shop.Product.DataTable');

Route::get('/product/achived', [ProductController::class, 'ProductIndex'])->name('Shop.ProductAchived.index');
Route::post('/product/achived', [ProductController::class, 'ProductIndex'])->name('Shop.Product.filter_archived');
Route::get('/product/DataTableArchived', [ProductController::class, 'DataTableArchived'])->name('Shop.Product.DataTableArchived');

Route::get('/product/SoftDelete/', [ProductController::class, 'ProductIndex'])->name('Shop.Product.SoftDelete');
Route::get('/product/DataTableSoftDelete/', [ProductController::class, 'DataTableSoftDelete'])->name('Shop.Product.DataTableSoftDelete');

Route::get('/product/create', [ProductController::class, 'create'])->name('Shop.Product.create');
Route::get('/product/create/ar', [ProductController::class, 'create'])->name('Shop.Product.create_ar');
Route::get('/product/create/en', [ProductController::class, 'create'])->name('Shop.Product.create_en');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('Shop.Product.edit');
Route::get('/product/editAr/{id}', [ProductController::class, 'edit'])->name('Shop.Product.editAr');
Route::get('/product/editEn/{id}', [ProductController::class, 'edit'])->name('Shop.Product.editEn');
Route::post('/product/update/{id}', [ProductController::class, 'storeUpdate'])->name('Shop.Product.update');

Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('Shop.Product.destroy');
Route::get('/product/restore/{id}', [ProductController::class, 'Restore'])->name('Shop.Product.restore');
Route::get('/product/force/{id}', [ProductController::class, 'ForceDeleteException'])->name('Shop.Product.force');
Route::get('/product/DeleteLang/{id}', [ProductController::class, 'DeleteLang'])->name('Shop.Product.DeleteLang');
Route::get('/product/emptyPhoto/{id}', [ProductController::class, 'emptyPhoto'])->name('Shop.Product.emptyPhoto');

Route::get('/product/photos/{id}', [ProductController::class, 'ListMorePhoto'])->name('Shop.Product.More_Photos');
Route::post('/product/AddMore', [ProductController::class, 'AddMorePhotos'])->name('Shop.Product.More_PhotosAdd');
Route::post('/product/saveSort', [ProductController::class, 'sortPhotoSave'])->name('Shop.Product.sortPhotoSave');
Route::get('/product/PhotoDel/{id}', [ProductController::class, 'More_PhotosDestroy'])->name('Shop.Product.More_PhotosDestroy');
Route::get('/product/config', [ProductController::class, 'config'])->name('Shop.Product.config');


Route::get('/product/attribute', [AttributeController::class, 'index'])->name('Shop.ProAttribute.index');
Route::get('/product/attribute/create', [AttributeController::class, 'create'])->name('Shop.ProAttribute.create');
Route::get('/product/attribute/edit/{id}', [AttributeController::class, 'edit'])->name('Shop.ProAttribute.edit');
Route::post('/product/attribute/update/{id}', [AttributeController::class, 'storeUpdate'])->name('Shop.ProAttribute.update');
Route::get('/product/attribute/destroy/{id}', [AttributeController::class, 'ForceDeleteException'])->name('Shop.ProAttribute.destroy');
Route::get('/product/attribute/Sort', [AttributeController::class, 'Sort'])->name('Shop.ProAttribute.Sort');
Route::post('/product/attribute/SaveSort', [AttributeController::class, 'SaveSort'])->name('Shop.ProAttribute.SaveSort');
Route::get('/product/attribute/config', [AttributeController::class, 'config'])->name('Shop.ProAttribute.config');


Route::get('/attribute/value/{AttributeId}', [AttributeValueController::class, 'index'])->name('Shop.ProAttributeValue.index');
Route::get('/attribute/value/create/{AttributeId}', [AttributeValueController::class, 'create'])->name('Shop.ProAttributeValue.create');
Route::get('/attribute/value/edit/{id}', [AttributeValueController::class, 'edit'])->name('Shop.ProAttributeValue.edit');
Route::post('/attribute/value/update/{id}', [AttributeValueController::class, 'storeUpdate'])->name('Shop.ProAttributeValue.update');
Route::get('/attribute/value/destroy/{id}', [AttributeValueController::class, 'ForceDeleteException'])->name('Shop.ProAttributeValue.destroy');
Route::get('/attribute/value/Sort/{AttributeId}', [AttributeValueController::class, 'Sort'])->name('Shop.ProAttributeValue.Sort');
Route::post('/attribute/value/SaveSort', [AttributeValueController::class, 'SaveSort'])->name('Shop.ProAttributeValue.SaveSort');
Route::get('/attribute/value/config/{AttributeId}', [AttributeValueController::class, 'config'])->name('Shop.ProAttributeValue.config');

Route::get('/product/manage-attribute/{id}', [ManageAttributeController::class, 'ManageAttribute'])->name('Shop.Product.manage-attribute');
Route::post('/product/manage-attribute-update/{id}', [ManageAttributeController::class, 'ManageAttributeUpdate'])->name('Shop.Product.manage-attributeUpdate');
Route::get('/product/remove-attribute/{proId}/{AttributeId}', [ManageAttributeController::class, 'RemoveAttribute'])->name('Shop.Product.remove-attribute');

Route::post('/product/attribute-value-update', [ManageAttributeController::class, 'ManageAttributeValueUpdate'])->name('Shop.Product.value-update');
Route::post('/product/UpdateVariants/{proId}', [ManageAttributeController::class, 'UpdateVariants'])->name('Shop.Product.UpdateVariants');
Route::get('/product/remove-variants/{proId}', [ManageAttributeController::class, 'RemoveVariants'])->name('Shop.Product.RemoveVariants');


Route::prefix('product/lp/')->name('LandingPage.')
    ->controller(ProductLandingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'PageCreate')->name('create');
        Route::get('/add-new', 'PageCreate')->name('AddNew');
        Route::get('/edit/{id}', 'PageEdit')->name('edit');
        Route::post('/update/{id}', 'PageStoreUpdate')->name('update');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/emptyPhoto/{id}', 'emptyPhoto')->name('emptyPhoto');
        Route::get('/config', 'config')->name('config');
    });




