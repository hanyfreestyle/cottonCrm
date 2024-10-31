<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTags;
use App\AppPlugin\Product\Models\ProductTagsTranslation;
use App\AppPlugin\Product\Models\ProductTranslation;
use App\AppPlugin\Product\Request\ProductRequest;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\AppPlugin\Product\Traits\ProductQuerybuilder;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class ProductController extends AdminMainController {

    use CrudTraits;
    use ProductConfigTraits;
    use ProductQuerybuilder;

    function __construct() {
        parent::__construct();
        $this->controllerName = "ProductList";
        $this->PrefixRole = 'Product';
        $this->selMenu = "admin.Product.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_product');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new Product();
        $this->translation = new ProductTranslation();
        $this->tags = new ProductTags();
        $this->tagsTranslation = new ProductTagsTranslation();
        $this->modelPhoto = new ProductPhoto();
        $this->modelPhotoColumn = 'product_id';

        $this->UploadDirIs = 'product';
        $this->translationdb = 'product_id';
        $this->PrefixTags = "admin.ProductTags";
        View::share('PrefixTags', $this->PrefixTags);

        $ProductType_Arr = [
            "1" => ['id' => '1', 'name' => __('admin/proProduct.pro_type_1')],
            "2" => ['id' => '2', 'name' => __('admin/proProduct.pro_type_2')],
        ];
        View::share('ProductType_Arr', $ProductType_Arr);

        $OnStock_Arr = [
            "1" => ['id' => '0', 'name' => __('admin/proProduct.pro_status_stock_0')],
            "2" => ['id' => '1', 'name' => __('admin/proProduct.pro_status_stock_1')],
        ];
        View::share('OnStock_Arr', $OnStock_Arr);

        $IsActive_Arr = [
            "1" => ['id' => '0', 'name' => __('admin/proProduct.pro_status_is_active_0')],
            "2" => ['id' => '1', 'name' => __('admin/proProduct.pro_status_is_active_1')],
        ];
        View::share('IsActive_Arr', $IsActive_Arr);

        $IsArchived_Arr = [
            "1" => ['id' => '0', 'name' => __('admin/proProduct.pro_is_archived_0')],
            "2" => ['id' => '1', 'name' => __('admin/proProduct.pro_is_archived_1')],
        ];
        View::share('IsArchived_Arr', $IsArchived_Arr);


        $this->CashBrandList = self::CashBrandList($this->StopeCash);
        View::share('CashBrandList', $this->CashBrandList);

        $this->CashCategoriesList = self::CashCategoriesList($this->StopeCash);
        View::share('CashCategoriesList', $this->CashCategoriesList);


        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'settings' => getDefSettings($this->config),
            'AddLang' => false,
        ];

        self::constructData($sendArr);
        self::loadCategoryPermission(array());

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('CashCategoryHomePage');
        Cache::forget('CashCategoryMenuList');
        Cache::forget('CashCategoryFilterList');
        Cache::forget('CashBrandMenuList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductIndex(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = 'index';
        $pageData['IconPage'] = "fas fa-shopping-cart";
        $pageData['Trashed'] = Product::onlyTrashed()->count();
        $currentRoute = Route::currentRouteName();

        if ($currentRoute == $this->PrefixRoute . '.Archived' or $currentRoute == $this->PrefixRoute . '.archived.filter') {
            $PageView = 'Archived';
            $filterRoute = ".archived.filter";
            $this->formName = "ProductArchivedFilter";
        } elseif ($currentRoute == $this->PrefixRoute . '.SoftDelete') {
            $PageView = 'SoftDelete';
            $filterRoute = null;
            $this->formName = "SoftDeleteFilter";
        } else {
            $PageView = 'index';
            $filterRoute = ".index.filter";
            $this->formName = "ProductIndexFilter";
        }

        View::share('formName', $this->formName);
        $session = self::getSessionData($request);
        $dataSend = [
            'PageView' => $PageView,
            'session' => $session,
        ];

        $rowData = self::ProductQuery($this->config, $dataSend, $session)->get();

        return view('AppPlugin.Product.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'filterRoute' => $filterRoute,
            'dataSend' => $dataSend,
            'session' => $session,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductDataTable(Request $request, $formName) {
        if ($request->ajax()) {
            $dataSend = $request->query('dataSend');
            $session = self::getSessionDataAjax($formName);
            $rowData = self::ProductQuery($this->config, $dataSend, $session);
            return self::ProductColumns($rowData, $dataSend, $formName)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Categories = Category::all();
        $rowData = Product::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];
        $tags = ProductTags::where('id', '!=', 0)->take(100)->get();
        $selTags = [];
        return view('AppPlugin.Product.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
            'viewEditor' => true,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $Categories = Category::all();
        $rowData = Product::where('id', $id)->with('categories')->with('attributes')->with('childproduct')->firstOrFail();
        $selCat = $rowData->categories()->pluck('category_id')->toArray();
        $LangAdd = self::getAddLangForEdit($rowData);
        $selTags = $rowData->tags()->pluck('tag_id')->toArray();
        $tags = ProductTags::whereIn('id', $selTags)->take(50)->get();

        return view('AppPlugin.Product.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(ProductRequest $request, $id = 0) {
        $saveData = Product::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $categories = $request->input('categories');
                $tags = $request->input('tag_id');

                $saveData->is_active = $request->input('is_active');
                $saveData->is_archived = $request->input('is_archived');
                $saveData->on_stock = $request->input('on_stock');
                $saveData->featured = $request->input('featured');
                $saveData->brand_id = $request->input('brand_id');

                $saveData->price = $request->input('price');
                $saveData->regular_price = $request->input('regular_price');
                $saveData->sales_count = $request->input('sales_count');
                $saveData->save();

                $saveData->categories()->sync($categories);
                $saveData->tags()->sync($tags);
                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');

                $saveData->pro_id = $saveData->id;

                if ($saveData->sku == null) {
                    $saveData->sku = $saveData->id . "-" . RandomNumber();
                }
                $saveData->save();

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $dbName = $this->translationdb;
                    $saveTranslation = $this->translation->where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$dbName = $saveData->id;
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->short_des = $request->input($key . '.short_des');
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }
            });

        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        self::UpdateDefCat();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateDefCat() {
        $products = Product::query()->where('parent_id', null)
            ->where('def_cat', null)
            ->with('categories')
            ->get();

        foreach ($products as $product) {
            $defCat = null;
            if (count($product->categories) > 1) {
                $defCat = $product->categories->where('parent_id', null)->first()->id ?? null;
                if ($defCat == null) {
                    $defCat = $product->categories->first()->id ?? null;
                }
            } elseif (count($product->categories) == 1) {
                $defCat = $product->categories->first()->id ?? null;
            }
            if ($defCat) {
                $product->def_cat = $defCat;
                $product->timestamps = false;
                $product->save();
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getChildProductName($childproduct) {
        $slug = explode('-', $childproduct->variants_slug_id);
        $values = self::CashAttributeValueList();
        $name = "";
        foreach ($slug as $id) {
            if (intval($id) != 0) {
                $name .= $values->where('id', $id)->first()->name . " / ";
            }
        }
        $name = rtrim($name, " / ");
        return $name;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdatePrices() {
        dd("check");
        $pageData = $this->pageData;
        $pageData['ViewType'] = "list";
        $pageData['SubView'] = false;

        $proId = ProductAttribute::get()->pluck('product_id')->toarray();

        $proId = array_unique($proId);
        $rowData = Product::wherein('id', $proId)
            ->where('is_archived', false)
            ->where('is_active', true)
            ->withcount('childproduct')
            ->having('childproduct_count', 0)
            ->get();

        $mainProduct = Product::where('parent_id', null)
            ->where('is_archived', false)
            ->where('is_active', true)
            ->withcount('childproduct')
            ->get();

        foreach ($mainProduct as $product) {
            $product->parents_count = $product->childproduct_count;
            $product->save();
        }


        $products = Product::where('parents_count', '>', 0)
            ->where('is_archived', false)
            ->where('is_active', true)
            ->with('attributes')
            ->get();

        foreach ($products as $product) {
            $new_parent_count = 1;
            foreach ($product->attributes as $attribute) {
                $new_parent_count = $new_parent_count * count(json_decode($attribute->pivot->values));
            }
            $product->attributes_count = $new_parent_count;
            $product->save();
        }


        $needUpdate = Product::where('parents_count', ">", 0)
            ->whereColumn('attributes_count', '!=', "parents_count")
            ->where('is_archived', false)
            ->where('is_active', true)
            ->get();

        return view('AppPlugin.Product.update_prices')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'needUpdate' => $needUpdate,
        ]);

    }



//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
//    public function ForceDeleteException($id) {
//        $deleteRow = Product::onlyTrashed()->where('id', $id)
//            ->with('more_photos')
//            ->withcount('orders')
//            ->firstOrFail();
//
//        if ($deleteRow->orders_count == 0) {
//            try {
//                DB::transaction(function () use ($deleteRow, $id) {
//                    if (count($deleteRow->more_photos) > 0) {
//                        foreach ($deleteRow->more_photos as $del_photo) {
//                            AdminHelper::DeleteAllPhotos($del_photo);
//                        }
//                    }
//                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
//                    $deleteRow->forceDelete();
//                });
//            } catch (\Exception $exception) {
//                return back()->with(['confirmException' => '', 'fromModel' => 'Product', 'deleteRow' => $deleteRow]);
//            }
//        } else {
//            return back()->with(['confirmException' => '', 'fromModel' => 'Product', 'deleteRow' => $deleteRow]);
//        }
//
//        self::ClearCash();
//        return back()->with('confirmDelete', "");
//    }
//
//
//


}



