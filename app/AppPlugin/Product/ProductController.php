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
use App\AppPlugin\Product\Traits\ProductBrandConfigTraits;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\WebMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class ProductController extends AdminMainController {

    use CrudTraits;
    use ProductConfigTraits;

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
        $this->PrefixTags = "admin.Product";
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

        $IsArchived_Arr = [
            "1" => ['id' => '0', 'name' => __('admin/proProduct.pro_is_archived_0')],
            "2" => ['id' => '1', 'name' => __('admin/proProduct.pro_is_archived_1')],
        ];
        View::share('IsArchived_Arr', $IsArchived_Arr);


        $this->CashBrandList = self::CashBrandList($this->StopeCash);
        View::share('CashBrandList', $this->CashBrandList);

        $this->CashCategoriesList = self::CashCategoriesList($this->StopeCash);
        View::share('CashCategoriesList', $this->CashCategoriesList);

//        $sendArr = [
//            'TitlePage' => $this->PageTitle,
//            'PrefixRoute' => $this->PrefixRoute,
//            'PrefixRole' => $this->PrefixRole,
//            'AddConfig' => true,
//            'configArr' => [
//                "datatable" => false,
//                "orderby" => false,
//                "editor" => 1,
//                'morePhotoFilterid' => 1
//            ],
//            'yajraTable' => true,
//            'AddLang' => true,
//            'restore' => 1,
//            'formName' => "ProductFilters",
//        ];
//
//        $Config = [
//            'TableCategory' => true,
//            'TableAddLang' => true,
//            'ProductBrand' => true,
//        ];
//        View::share('Config', $Config);
//
//
//        self::loadConstructData($sendArr);
//
//        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['index', 'CategoryIndex']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => ['create', 'CategoryCreate']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => ['UpdatePrices']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => ['destroy', 'destroyException']]);
//        $this->middleware('permission:' . $this->PrefixRole . '_restore', ['only' => ['SoftDeletes', 'Restore', 'ForceDelete']]);

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
        $session = self::getSessionData($request);
        $currentRoute = Route::currentRouteName();


        if ($currentRoute == $this->PrefixRoute . '.Archived') {
//            $filterRoute = ".filter_archived";
            $PageView = 'Archived';
        } elseif ($currentRoute == $this->PrefixRoute . '.SoftDelete') {

//            $filterRoute = ".filter";

            $PageView = 'SoftDelete';
        } else {

//            $filterRoute = ".filter";
            $PageView = 'index';
        }

//        $rowData = self::ProductQuery($this->config);
//        dd($this->config);

//        if ($session == null) {
//            $rowData = $this->model::def()->where('is_archived', $is_archived)->count();
//        } else {
//            $rowData = self::ProductFilterQ($this->model::def()->where('is_archived', $is_archived), $session)->count();
//        }


        $dataSend = [
            'PageView' => $PageView,
        ];


//        $rowData = self::ProductQuery($this->config,$dataSend);
//        dd($rowData->get());
//        dd($rowData->first());

        return view('AppPlugin.Product.index')->with([
            'pageData' => $pageData,
//            'rowData' => $rowData,
//            'route' => $route,
//            'filterRoute' => $filterRoute,
            'dataSend' => $dataSend,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductDataTable(Request $request) {
        if ($request->ajax()) {
            $dataSend = $request->query('dataSend');
            $rowData = self::ProductQuery($this->config, $dataSend);
            return self::ProductColumns($rowData, $dataSend)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductQuery($config, $dataSend) {

        $table = $config['DbPost'];
        $table_trans = $config['DbPostTrans'];
        $table_trans_foreign = $config['DbPostForeignId'];
        $locale = dataTableDefLang();
        $table_category = $config['DbCategory'];
        $table_category_trans = $config['DbCategoryTrans'];
        $table_category_pivot = $config['DbCategoryPivot'];

        $table_brand = $config['DbBrand'];
        $table_brand_trans = $config['DbBrandTrans'];
        $table_brand_trans_foreign = 'brand_id';


        if ($dataSend['PageView'] == 'SoftDelete') {
            $data = DB::table($table)->whereNotNull("$table.deleted_at");
        }elseif ($dataSend['PageView'] == 'Archived'){
            $data = DB::table($table)->whereNull("$table.deleted_at")->where("$table.is_archived",true);
        } else {
            $data = DB::table($table)->whereNull("$table.deleted_at")->where("$table.is_archived",false);
        }

        $data->whereNull("$table.parent_id");


        $data->leftJoin($table_trans, function ($join) use ($table, $table_trans, $table_trans_foreign, $locale) {
            $join->on("$table.id", '=', "$table_trans.$table_trans_foreign")
                ->where("$table_trans.locale", '=', $locale);
        });

        $data->leftJoin($table_category_pivot, "$table.id", '=', "$table_category_pivot.$table_trans_foreign")
            ->leftJoin($table_category, "$table_category_pivot.category_id", '=', "$table_category.id")
            ->leftJoin($table_category_trans, function ($join) use ($table_category, $table_category_trans, $locale) {
                $join->on("$table_category.id", '=', "$table_category_trans.category_id")
                    ->where("$table_category_trans.locale", '=', $locale);
            });

        $data->leftJoin($table_brand, "$table.brand_id", '=', "$table_brand.id")
            ->leftJoin($table_brand_trans, function ($join) use ($table_brand, $table_brand_trans, $table_brand_trans_foreign, $locale) {
                $join->on("$table_brand.id", '=', "$table_brand_trans.$table_brand_trans_foreign")
                    ->where("$table_brand_trans.locale", '=', $locale);
            });

        $data->select(
            "$table.id as id",
            DB::raw("MAX($table.is_active) as is_active"),
            DB::raw("MAX($table.deleted_at) as deleted_at"),
            DB::raw("MAX($table.price) as price"),
            DB::raw("MAX($table.regular_price) as regular_price"),
            DB::raw("MAX($table.is_active) as isActive"),
            DB::raw("MAX($table.photo_thum_1) as photo"),
            DB::raw("MAX($table_trans.name) as name"),
            DB::raw("MAX($table_trans.slug) as slug"),
        );

        $data->addSelect(
            DB::raw("GROUP_CONCAT(CONCAT($table_category.id, ':', $table_category_trans.name)) as category_names")
        );

        $data->addSelect(
            DB::raw("MAX($table_brand_trans.name) as brand_name") // إضافة اسم العلامة التجارية
        );


        $data->groupBy("$table.id");


        return $data;

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ProductColumns($data, $dataSend) {

        return DataTables::query($data, $dataSend)
            ->addIndexColumn()
            ->addColumn('photo', function ($row) {
                return TablePhoto($row, 'photo');
            })
            ->editColumn('CategoryName', function ($row) {
                return view('datatable.but')->with(['btype' => 'CategoryName', 'row' => $row])->render();
            })
            ->editColumn('regular_price', function ($row) {
                return number_format($row->regular_price);
            })
            ->editColumn('price', function ($row) {
                return number_format($row->price);
            })


            ->addColumn('isActive', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] != 'SoftDelete') {
                    return is_active($row->is_active);
                }
            })

            ->addColumn('Edit', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] != 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
                }
            })

            ->editColumn('Delete', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] != 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
                }
            })

            ->editColumn('deleted_at', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] == 'SoftDelete') {
                    return [
                        'display' => Carbon::parse($row->deleted_at)->format('Y-m-d'),
                        'timestamp' => Carbon::parse($row->deleted_at)->timestamp
                    ];
                }
            })
            ->addColumn('Restore', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] == 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'Restore', 'row' => $row])->render();
                }
            })
            ->addColumn('ForceDelete', function ($row) use ($dataSend) {
                if ($dataSend['PageView'] == 'SoftDelete') {
                    return view('datatable.but')->with(['btype' => 'ForceDelete', 'row' => $row])->render();
                }
            })
            ->addColumn('hany', function ($row) use ($dataSend) {
                return $dataSend['PageView'];
            })
            ->rawColumns(["photo", 'CategoryName', 'Edit', "Delete", 'AddLang', "Restore", "ForceDelete", "isActive"]);
    }






//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #   DataTable
//    public function ProductDataTable(Request $request) {
//        if ($request->ajax()) {
//            $session = self::getSessionData($request);
//            if ($session == null) {
//                $data = $this->model::select(['pro_product.id', 'photo_thum_1', 'is_active', 'price', 'regular_price', 'brand_id'])
//                    ->where('parent_id', null)->where('is_archived', 0)->with('tablename');
//            } else {
//                $data = self::ProductFilterQ($this->model::select(['pro_product.id', 'photo_thum_1', 'is_active', 'price', 'regular_price', 'brand_id'])
//                    ->where('parent_id', null)->where('is_archived', 0)->with('tablename'), $session);
//            }
//            return self::DataTableProductColumns($data)->make(true);
//        }
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #   DataTable
//    public function DataTableArchived(Request $request) {
//        if ($request->ajax()) {
//            $session = self::getSessionData($request);
//            if ($session == null) {
//                $data = $this->model::select(['pro_product.id', 'photo_thum_1', 'is_active', 'price', 'regular_price', 'brand_id'])
//                    ->where('parent_id', null)->where('is_archived', 1)->with('tablename');
//            } else {
//                $data = self::ProductFilterQ($this->model::select(['pro_product.id', 'photo_thum_1', 'is_active', 'price', 'regular_price', 'brand_id'])
//                    ->where('parent_id', null)->where('is_archived', 1)->with('tablename'), $session);
//            }
//            return self::DataTableProductColumns($data)->make(true);
//        }
//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #   DataTable
//    public function DataTableSoftDelete(Request $request) {
//        if ($request->ajax()) {
//            $data = $this->model::onlyTrashed()->select(['pro_product.id', 'photo_thum_1', 'is_active', 'price', 'regular_price', 'brand_id'])
//                ->where('parent_id', null)->with('tablename');
//            return self::DataTableProductColumns($data)->make(true);
//
//        }
//    }
//
//
//

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function UpdatePrices() {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "list";
//        $pageData['SubView'] = false;
//
//        $proId = ProductAttribute::get()->pluck('product_id')->toarray();
//
//        $proId = array_unique($proId);
//        $rowData = Product::wherein('id', $proId)
//            ->where('is_archived', false)
//            ->where('is_active', true)
//            ->withcount('childproduct')
//            ->having('childproduct_count', 0)
//            ->get();
//
//        $mainProduct = Product::where('parent_id', null)
//            ->where('is_archived', false)
//            ->where('is_active', true)
//            ->withcount('childproduct')
//            ->get();
//
//        foreach ($mainProduct as $product) {
//            $product->parents_count = $product->childproduct_count;
//            $product->save();
//        }
//
//
//        $products = Product::where('parents_count', '>', 0)
//            ->where('is_archived', false)
//            ->where('is_active', true)
//            ->with('attributes')
//            ->get();
//
//        foreach ($products as $product) {
//            $new_parent_count = 1;
//            foreach ($product->attributes as $attribute) {
//                $new_parent_count = $new_parent_count * count(json_decode($attribute->pivot->values));
//            }
//            $product->attributes_count = $new_parent_count;
//            $product->save();
//        }
//
//
//        $needUpdate = Product::where('parents_count', ">", 0)
//            ->whereColumn('attributes_count', '!=', "parents_count")
//            ->where('is_archived', false)
//            ->where('is_active', true)
//            ->get();
//
//        return view('AppPlugin.Product.update_prices')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//            'needUpdate' => $needUpdate,
//        ]);
//
//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     create
//    public function create() {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "Add";
//        $Categories = Category::all();
//        $rowData = Product::findOrNew(0);
//        $LangAdd = self::getAddLangForAdd();
//        $selCat = [];
//        $tags = ProductTags::where('id', '!=', 0)->take(100)->get();
//
//
//        $selTags = [];
//
//        return view('AppPlugin.Product.form')->with([
//            'pageData' => $pageData,
//            'rowData' => $rowData,
//            'Categories' => $Categories,
//            'LangAdd' => $LangAdd,
//            'selCat' => $selCat,
//            'tags' => $tags,
//            'selTags' => $selTags,
//            'viewEditor' => true,
//        ]);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     edit
//    public function edit($id) {
//        $pageData = $this->pageData;
//        $pageData['ViewType'] = "Edit";
//        $Categories = Category::all();
//        $rowData = Product::where('id', $id)->with('categories')->with('attributes')->with('childproduct')->firstOrFail();
//        $selCat = $rowData->categories()->pluck('category_id')->toArray();
//        $LangAdd = self::getAddLangForEdit($rowData);
//        $selTags = $rowData->tags()->pluck('tag_id')->toArray();
//        $tags = ProductTags::whereIn('id', $selTags)->take(50)->get();
//
//        return view('AppPlugin.Product.form')->with(
//            [
//                'pageData' => $pageData,
//                'rowData' => $rowData,
//                'Categories' => $Categories,
//                'LangAdd' => $LangAdd,
//                'selCat' => $selCat,
//                'tags' => $tags,
//                'selTags' => $selTags,
//            ]
//        );
//    }
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function storeUpdate(ProductRequest $request, $id = 0) {
//        $saveData = Product::findOrNew($id);
//
//        try {
//            DB::transaction(function () use ($request, $saveData) {
//                $categories = $request->input('categories');
//                $tags = $request->input('tag_id');
//
//                $saveData->is_active = $request->input('is_active');
//                $saveData->is_archived = $request->input('is_archived');
//                $saveData->on_stock = $request->input('on_stock');
//                $saveData->featured = $request->input('featured');
//                $saveData->brand_id = $request->input('brand_id');
//
//                $saveData->price = $request->input('price');
//                $saveData->regular_price = $request->input('regular_price');
//                $saveData->sales_count = $request->input('sales_count');
//                $saveData->save();
//
//                $saveData->categories()->sync($categories);
//                $saveData->tags()->sync($tags);
//                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');
//
//                $saveData->pro_id = $saveData->id;
//
//                if ($saveData->sku == null) {
//                    $saveData->sku = $saveData->id . "-" . RandomNumber();
//                }
//                $saveData->save();
//
//                $addLang = json_decode($request->add_lang);
//                foreach ($addLang as $key => $lang) {
//                    $dbName = $this->translationdb;
//                    $saveTranslation = $this->translation->where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
//                    $saveTranslation->$dbName = $saveData->id;
//                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
//                    $saveTranslation->short_des = $request->input($key . '.short_des');
//                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
//                    $saveTranslation->save();
//                }
//            });
//
//        } catch (\Exception $exception) {
//            return back()->with('data_not_save', "");
//        }
//        self::ClearCash();
//        self::UpdateDefCat();
//        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
//
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//
//    public function UpdateDefCat() {
//
//        $products = Product::query()->where('parent_id', null)
//            ->where('def_cat', null)
//            ->with('categories')
//            ->get();
//
//        foreach ($products as $product) {
//            $defCat = null;
//            if (count($product->categories) > 1) {
//                $defCat = $product->categories->where('parent_id', null)->first()->id ?? null;
//                if ($defCat == null) {
//                    $defCat = $product->categories->first()->id ?? null;
//                }
//            } elseif (count($product->categories) == 1) {
//                $defCat = $product->categories->first()->id ?? null;
//            }
//            if ($defCat) {
//                $product->def_cat = $defCat;
//                $product->timestamps = false;
//                $product->save();
//            }
//        }
//
//    }
//
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
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #   ProductFilterQ
//    static function ProductFilterQ($query, $session, $order = null) {
//
//        $query->where('id', '!=', 0);
//
//        if (isset($session['from_date']) and $session['from_date'] != null) {
//            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
//        }
//
//        if (isset($session['to_date']) and $session['to_date'] != null) {
//            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
//        }
//
//        if (isset($session['is_active']) and $session['is_active'] != null) {
//            $query->where('is_active', $session['is_active']);
//        }
//
//        if (isset($session['type']) and $session['type'] != null) {
//            if ($session['type'] == 1) {
//                $query->withcount('childproduct')->having('childproduct_count', 0);
//            } else {
//                $query->withcount('childproduct')->having('childproduct_count', ">", 0);
//            }
//        }
//
//        if (isset($session['price_from']) and $session['price_from'] != null and intval($session['price_from']) > 0) {
//            $query->where('price', ">=", $session['price_from']);
//        }
//
//        if (isset($session['price_to']) and $session['price_to'] != null and intval($session['price_to']) > 0) {
//            $query->where('price', "<=", $session['price_to']);
//        }
//
//
//        if (isset($session['brand_id']) and $session['brand_id'] != null) {
//            $query->where('brand_id', $session['brand_id']);
//        }
//
//        if (isset($session['cat_id']) and $session['cat_id'] != null) {
//            $id = $session['cat_id'];
//            $query->whereHas('categories', function ($query) use ($id) {
//                $query->where('category_id', $id);
//            });
//        }
//
//        if (isset($session['on_stock']) and $session['on_stock'] != null) {
//            $query->where('on_stock', $session['on_stock']);
//        }
//
//        if (isset($session['name']) and $session['name'] != null) {
//            $query->whereTranslationLike('name', '%' . $session['name'] . '%');
//        }
//
//
//        if ($order != null) {
//            $orderBy = explode("|", $order);
//            $query->orderBy($orderBy[0], $orderBy[1]);
//        }
//
//        return $query;
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    static function getChildProductName($childproduct) {
//        $slug = explode('-', $childproduct->variants_slug_id);
//        $values = WebMainController::CashAttributeValueList();
//        $name = "";
//        foreach ($slug as $id) {
//            if (intval($id) != 0) {
//                $name .= $values->where('id', $id)->first()->name . " / ";
//            }
//        }
//        $name = rtrim($name, " / ");
//        return $name;
//    }
//

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashCategoriesList($stopCash = 0) {
        if ($stopCash) {
            $CashCategoriesList = Category::CashCategoriesList();
        } else {
            $CashCategoriesList = Cache::remember('CashCategoriesList', cashDay(7), function () {
                return Category::CashCategoriesList();
            });
        }
        return $CashCategoriesList;
    }


}



