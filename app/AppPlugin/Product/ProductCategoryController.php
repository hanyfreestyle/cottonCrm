<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefCategoryRequest;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class ProductCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits;
    use ProductConfigTraits ;

    function __construct() {
        parent::__construct();
        $this->controllerName = "Category";
        $this->PrefixRole = 'Product';
        $this->selMenu = "admin.Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new Category();
        $this->translation = new CategoryTranslation();
        $this->translationdb = 'category_id';
        $this->UploadDirIs = 'category';


        $this->config = self::LoadConfig();
        if($this->TableCategory){
            self::SetCatTree($this->config['categoryTree'],$this->config['categoryDeep']);
        }
        View::share('config', $this->config);


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1],
            'yajraTable' => false,
            'AddLang' => true,
        ];

        self::constructData($sendArr);
        self::loadCategoryPermission(array());

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashCategoryMenuList');
        Cache::forget('CashCategoryFilterList');
        Cache::forget('CashCategoryHomePage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryStoreUpdate
    public function CategoryStoreUpdate(DefCategoryRequest $request, $id = 0) {
        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id) {
        $deleteRow = Category::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_product')
            ->firstOrFail();

        if($deleteRow->del_category_count == 0 and $deleteRow->del_product_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'CategoryProduct', 'deleteRow' => $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'CategoryProduct', 'deleteRow' => $deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


}
