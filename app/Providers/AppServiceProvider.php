<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Encryption\Encrypter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider {

    public const HOME = '/';

    #public const HOME = '/ar/AppPanel/Home';


    public function register(): void {
        foreach (glob(app_path() . '/Helpers/function/*.php') as $filename) {
            require_once($filename);
        }
    }


    public function boot(): void {

        Paginator::useBootstrap();
        LogViewer::auth(function ($request) {
            return $request->user() && in_array($request->user()->email, ['test@test.com',]);
        });

        $key = $this->databaseEncryptionKey();
        $cipher = config('app.cipher');
        Model::encryptUsing(new Encrypter($key, $cipher));

        Route::macro('CategoryRoute', function ($prefixFolder, $prefixRoute, $controller) {
            Route::prefix($prefixFolder)->name($prefixRoute)->group(function () use ($controller) {
                Route::get('/', [$controller, 'CategoryIndex'])->name('index');
                Route::get('/main', [$controller, 'CategoryIndex'])->name('index_Main');
                Route::get('/sub-category/{id}', [$controller, 'CategoryIndex'])->name('SubCategory');

                Route::get('/DataTable/all', [$controller, 'DataTable'])->name('DataTable');
                Route::get('/DataTable/main', [$controller, 'DataTableMain'])->name('DataTableMain');
                Route::get('/DataTable/sub/{id}', [$controller, 'DataTableSub'])->name('DataTableSub');

                Route::get('/create', [$controller, 'CategoryCreate'])->name('create');
                Route::get('/create/ar', [$controller, 'CategoryCreate'])->name('create_ar');
                Route::get('/create/en', [$controller, 'CategoryCreate'])->name('create_en');

                Route::get('/edit/{id}', [$controller, 'CategoryEdit'])->name('edit');
                Route::get('/editAr/{id}', [$controller, 'CategoryEdit'])->name('editAr');
                Route::get('/editEn/{id}', [$controller, 'CategoryEdit'])->name('editEn');

                Route::post('/update/{id}', [$controller, 'CategoryStoreUpdate'])->name('update');

                Route::get('/destroy/{id}', [$controller, 'destroyException'])->name('destroy');
                Route::get('/destroyEdit/{id}', [$controller, 'destroyException'])->name('destroyEdit');

                Route::get('/emptyPhoto/{id}', [$controller, 'emptyPhoto'])->name('emptyPhoto');
                Route::get('/DeleteLang/{id}', [$controller, 'DeleteLang'])->name('DeleteLang');
                Route::get('/config/', [$controller, 'CategoryConfig'])->name('config');

                Route::get('/CatSort/{id}', [$controller, 'CategorySort'])->name('CatSort');
                Route::post('/SaveSort', [$controller, 'CategorySaveSort'])->name('SaveSort');
            });
        });

        Route::macro('PostRoutes', function ($prefixFolder, $prefixRoute, $controller) {
            Route::prefix($prefixFolder)->name($prefixRoute)->group(function () use ($controller) {
                Route::get('/', [$controller, 'PostIndex'])->name('index');
                Route::get('/DataTable', [$controller, 'PostDataTable'])->name('DataTable');
                Route::get('/category/{categoryId}', [$controller, 'PostListCategory'])->name('FilterCategory');
                Route::get('/category/DataTable/{categoryId}', [$controller, 'PostDataTableCategory'])->name('DataTableCategory');

                Route::get('/soft-delete', [$controller, 'PostSoftDeletes'])->name('SoftDelete');
                Route::get('/soft-delete/DataTable', [$controller, 'PostDataTableSoftDeletes'])->name('DataTableSoftDeletes');

                Route::get('/create/new', [$controller, 'PostCreate'])->name('createNew');
                Route::get('/create', [$controller, 'PostCreate'])->name('create');
                Route::get('/create/ar', [$controller, 'PostCreate'])->name('create_ar');
                Route::get('/create/en', [$controller, 'PostCreate'])->name('create_en');

                Route::get('/edit/{id}', [$controller, 'PostEdit'])->name('edit');
                Route::get('/editAr/{id}', [$controller, 'PostEdit'])->name('editAr');
                Route::get('/editEn/{id}', [$controller, 'PostEdit'])->name('editEn');

                Route::post('/update/{id}', [$controller, 'PostStoreUpdate'])->name('update');

                Route::get('/destroy/{id}', [$controller, 'destroy'])->name('destroy');
                Route::get('/destroy-edit/{id}', [$controller, 'destroyEdit'])->name('destroyEdit');
                Route::get('/restore/{id}', [$controller, 'Restore'])->name('restore');
                Route::get('/force/{id}', [$controller, 'PostForceDeleteException'])->name('force');
                Route::get('/DeleteLang/{id}', [$controller, 'DeleteLang'])->name('DeleteLang');
                Route::get('/emptyPhoto/{id}', [$controller, 'emptyPhoto'])->name('emptyPhoto');

                Route::get('/more-photos/{id}', [$controller, 'morePhotos_list'])->name('morePhotos_list');
                Route::post('/more-photos/add', [$controller, 'morePhotos_add'])->name('morePhotos_add');
                Route::get('/more-photos/edit/{id}', [$controller, 'morePhotos_edit'])->name('morePhotos_edit');
                Route::post('more-photos/save-sort/', [$controller, 'morePhotos_saveSort'])->name('morePhotos.saveSort');
                Route::get('/more-photos/delete/{id}', [$controller, 'morePhotos_delete'])->name('morePhotos_delete');
                Route::get('/more-photos/delete-all/{postId}', [$controller, 'morePhotos_deleteAll'])->name('morePhotos_deleteAll');

                Route::post('/more-photos/update/{postId}', [$controller, 'morePhotos_update'])->name('morePhotos_update');
                Route::get('/more-photos/edit-all/{postId}', [$controller, 'morePhotos_editAll'])->name('morePhotos_editAll');
                Route::post('/more-photos/update-all/{id}', [$controller, 'morePhotos_updateAll'])->name('morePhotos_updateAll');

                Route::get('/config', [$controller, 'config'])->name('config');
            });
        });

        Route::macro('TagsRoutes', function ($prefixFolder, $prefixRoute, $prefixTags, $controller) {
            Route::prefix($prefixFolder)->name($prefixRoute)->group(function () use ($controller) {
                Route::get('/', [$controller, 'TagsIndex'])->name('index');
                Route::get('/DataTable', [$controller, 'TagsDataTable'])->name('DataTable');
                Route::get('/create', [$controller, 'TagsCreate'])->name('create');
                Route::get('/edit/{id}', [$controller, 'TagsEdit'])->name('edit');
                Route::post('/update/{id}', [$controller, 'TagsStoreUpdate'])->name('update');
                Route::get('/destroy/{id}', [$controller, 'TagsDelete'])->name('destroy');
            });

            Route::prefix($prefixFolder)->name($prefixTags)->group(function () use ($controller) {
                Route::get('/TagsSearch', [$controller, 'TagsSearch'])->name('TagsSearch');
                Route::get('/TagsOnFly', [$controller, 'TagsOnFly'])->name('TagsOnFly');
            });
        });
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    protected function databaseEncryptionKey(): ?string {
        $key = config('app.encryption_key');
        return base64_decode(Str::after($key, 'base64:'));
    }

}
