<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeTranslation;
use App\AppPlugin\Product\Request\AttributeRequest;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class AttributeController extends AdminMainController {
    use CrudTraits;
    use ProductConfigTraits;

    function __construct(Attribute $model) {
        parent::__construct();
        $this->controllerName = "ProAttribute";
        $this->PrefixRole = 'Product';
        $this->selMenu = "admin.Product.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_attribute');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->PrefixRouteSub = $this->selMenu . 'ProAttributeValue';
        $this->model = $model;

        $this->config = self::LoadConfig();
        View::share('config', $this->config);
        View::share('PrefixRouteSub', $this->PrefixRouteSub);

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
        Cache::forget('CashAttributeValueList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;

//        $rowData = self::PageIndexQuery($this->config);
//        dd($rowData->get());

        return view('AppPlugin.Product.attribute.index')->with([
            'pageData' => $pageData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $rowData = self::PageIndexQuery($this->config);
            return self::PageViewColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = Attribute::findOrNew(0);
        return view('AppPlugin.Product.attribute.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = Attribute::where('id', $id)->firstOrFail();
        return view('AppPlugin.Product.attribute.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(AttributeRequest $request, $id = 0) {
        $saveData = Attribute::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->type = intval((bool)$request->input('type'));
                $saveData->save();
                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = AttributeTranslation::where('attribute_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->attribute_id = $saveData->id;
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Sort() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $thisRow = null;
        $rowData = Attribute::orderBy('postion')->get();
        return view('AppPlugin.Product.attribute.sort')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'thisRow' => $thisRow,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = Attribute::findOrFail($id);
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForceDeleteException($id) {
        dd('working');
        $deleteRow = Attribute::where('id', $id)->withcount('values')->firstOrFail();

        if ($deleteRow->values_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'Attribute', 'deleteRow' => $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'Attribute', 'deleteRow' => $deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function PageIndexQuery($config, $route = 'all', $id = null) {

        $data = DB::table('pro_attribute')
            ->join('pro_attribute_lang', function ($join) {
                $join->on('pro_attribute.id', '=', 'pro_attribute_lang.attribute_id')
                    ->where('pro_attribute_lang.locale', '=', 'ar');
            })
            ->leftJoin('pro_attribute_value', 'pro_attribute.id', '=', 'pro_attribute_value.attribute_id')
            ->leftJoin('pro_attribute_value_lang', function ($join) {
                $join->on('pro_attribute_value.id', '=', 'pro_attribute_value_lang.value_id')
                    ->where('pro_attribute_value_lang.locale', '=', 'ar');
            })
            ->select(
                'pro_attribute.id as id',
                'pro_attribute.is_active as is_active',
                'pro_attribute_lang.name as name',
                DB::raw('GROUP_CONCAT(pro_attribute_value_lang.name) as values_names')
            )
            ->groupBy('pro_attribute.id', 'pro_attribute.is_active', 'pro_attribute_lang.name');

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageViewColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('values_names', function ($row) {
                if ($row->values_names) {
                    $values_names = explode(',', $row->values_names);
                    $printName = '';
                    foreach ($values_names as $name) {
                        $printName .= '<span class="cat_table_name">' . $name . '</span> ';
                    }
                    return $printName;
                } else {
                    return null;
                }
            })
            ->editColumn('isActive', function ($row) {
                return is_active($row->is_active);
            })
            ->editColumn('AttValueList', function ($row) {
                return Table_Btn(route($this->PrefixRouteSub . '.index', $row->id), "fas fa-search", "p", __('admin/form.button_list'));
            })
            ->editColumn('AttValueAdd', function ($row) {
                return Table_Btn(route($this->PrefixRouteSub . '.create', $row->id), "fas fa-plus", "dark", __('admin/form.button_add'));
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'values_names', 'isActive', 'name', 'AttValueList', 'AttValueAdd',]);
    }
}

