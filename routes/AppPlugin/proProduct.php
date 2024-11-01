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
Route::get('/product/update-prices', [ProductController::class, 'UpdatePrices'])->name('Product.UpdatePrices.index');


Route::CategoryRoute('product/category', 'Product.Category.', ProductCategoryController::class);
Route::CategoryRoute('product/brand/', 'Product.Brand.', ProductBrandController::class);
Route::TagsRoutes('product/tags/', 'Product.ProductTags.', 'ProductTags.', ProductTagsController::class);

Route::prefix('product')->name('Product.ProductList.')
    ->controller(ProductController::class)->group(function () {
        // المسارات العامة
        Route::get('/index', 'ProductIndex')->name('index');
        Route::get('/archived', 'ProductIndex')->name('Archived');
        Route::get('/soft-delete', 'ProductIndex')->name('SoftDelete');
        Route::get('/data-table/{formName}', 'ProductDataTable')->name('DataTable');

        Route::post('/index/', 'ProductIndex')->name('index.filter');
        Route::post('/archived/', 'ProductIndex')->name('archived.filter');

        // إنشاء وتعديل المنتجات
        Route::get('/create', 'create')->name('createNew');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'storeUpdate')->name('update');

        // حذف واستعادة المنتجات
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/restore/{id}', 'Restore')->name('restore');
        Route::get('/force/{id}', 'ForceDeleteException')->name('force');
        Route::get('/emptyPhoto/{id}', 'emptyPhoto')->name('emptyPhoto');

        // إدارة الصور الإضافية
        Route::get('/more-photos/{id}', 'morePhotos_list')->name('morePhotos_list');
        Route::post('/more-photos/add', 'morePhotos_add')->name('morePhotos_add');
        Route::get('/more-photos/edit/{id}', 'morePhotos_edit')->name('morePhotos_edit');
        Route::post('more-photos/save-sort/', 'morePhotos_saveSort')->name('morePhotos.saveSort');
        Route::get('/more-photos/delete/{id}', 'morePhotos_delete')->name('morePhotos_delete');
        Route::get('/more-photos/delete-all/{postId}', 'morePhotos_deleteAll')->name('morePhotos_deleteAll');

        Route::post('/more-photos/update/{postId}', 'morePhotos_update')->name('morePhotos_update');
        Route::get('/more-photos/edit-all/{postId}', 'morePhotos_editAll')->name('morePhotos_editAll');
        Route::post('/more-photos/update-all/{id}', 'morePhotos_updateAll')->name('morePhotos_updateAll');

        // إعدادات المنتج
        Route::get('/config', 'config')->name('config');
    });

Route::prefix('product/attribute')->name('Product.ProAttribute.')
    ->controller(AttributeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/DataTable', 'DataTable')->name('DataTable');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'storeUpdate')->name('update');
        Route::get('/destroy/{id}', 'ForceDeleteException')->name('destroy');
        Route::get('/sort', 'Sort')->name('Sort');
        Route::post('/save-sort', 'SaveSort')->name('SaveSort');
    });

Route::prefix('product/att/value')->name('Product.ProAttributeValue.')
    ->controller(AttributeValueController::class)->group(function () {
        Route::get('/{AttributeId}', 'index')->name('index');
        Route::get('/{AttributeId}/DataTable', 'DataTable')->name('DataTable');
        Route::get('/create/{AttributeId}', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'storeUpdate')->name('update');
        Route::get('/destroy/{id}', 'ForceDeleteException')->name('destroy');
        Route::get('/sort/{AttributeId}', 'Sort')->name('Sort');
        Route::post('/save-sort', 'SaveSort')->name('SaveSort');
    });


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



