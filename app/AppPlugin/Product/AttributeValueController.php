<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\AttributeValueTranslation;
use App\AppPlugin\Product\Request\AttributeValueRequest;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class AttributeValueController extends AdminMainController {

    use CrudTraits;
    use ProductConfigTraits;

    function __construct(Request $request, AttributeValue $model) {
        parent::__construct();
        $this->controllerName = "ProAttributeValue";
        $this->PrefixRole = 'Product';
        $this->selMenu = "admin.Product.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_attribute');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->PrefixRouteSub = $this->selMenu . 'ProAttribute';

        $this->config = self::LoadConfig();
        View::share('config', $this->config);
        View::share('PrefixRouteSub', $this->PrefixRouteSub);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'settings' => getDefSettings($this->config),
            'AddLang' => false,
            'WithSubCat' => true,
            'ModelId' => $request->route()->parameter('AttributeId'),
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
    public function index($AttributeId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;

        $Attribute = Attribute::query()
            ->with('translation')
            ->where('id', $AttributeId)
            ->firstOrFail();

        return view('AppPlugin.Product.attribute_value.index')->with([
            'pageData' => $pageData,
            'Attribute' => $Attribute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request, $AttributeId) {
        if ($request->ajax()) {
            $rowData = self::PageIndexQuery($AttributeId);
            return self::PageViewColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create($AttributeId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $Attribute = Attribute::with('translation')->where('id', $AttributeId)->firstOrFail();

        $rowData = AttributeValue::findOrNew(0);

        return view('AppPlugin.Product.attribute_value.form')->with([
            'pageData' => $pageData,
            'Attribute' => $Attribute,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = AttributeValue::where('id', $id)->firstOrFail();
        $Attribute = Attribute::with('translation')->where('id', $rowData->attribute_id)->firstOrFail();
        return view('AppPlugin.Product.attribute_value.form')->with([
            'pageData' => $pageData,
            'Attribute' => $Attribute,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(AttributeValueRequest $request, $id = 0) {
        $saveData = AttributeValue::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->attribute_id = $request->input('attribute_id');
                $saveData->save();
                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = AttributeValueTranslation::where('value_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->value_id = $saveData->id;
                    $saveTranslation->name = $request->input($key . '.name');
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhereNew($request, $id, route($this->PrefixRoute . '.index', $request->input('attribute_id')));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Sort($AttributeId) {

        $Attribute = Attribute::query()->with('translation')
            ->where('id', $AttributeId)
            ->firstOrFail();
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $rowData = AttributeValue::query()
            ->where('attribute_id', $Attribute->id)
            ->orderBy('position')
            ->get();

        return view('AppPlugin.Product.attribute_value.sort')->with([
            'pageData' => $pageData,
            'Attribute' => $Attribute,
            'rowData' => $rowData,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = AttributeValue::findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeleteException($id) {
        dd('working');
        $deleteRow = Product::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
        if (count($deleteRow->more_photos) > 0) {
            foreach ($deleteRow->more_photos as $del_photo) {
                AdminHelper::DeleteAllPhotos($del_photo);
            }
        }
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        AdminHelper::DeleteDir($this->UploadDirIs, $id);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function PageIndexQuery($AttributeId) {

        $locale = dataTableDefLang();
        $table = "pro_attribute_value";
        $table_trans = "pro_attribute_value_lang";
        $data = DB::table($table)
            ->where($table . ".attribute_id", $AttributeId)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.value_id')
            ->where($table_trans . '.locale', '=', $locale)
            ->select("$table.id as id",
                "$table.is_active as is_active",
                "$table_trans.name",
            );
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
            ->editColumn('isActive', function ($row) {
                return is_active($row->is_active);
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'values_names', 'isActive', 'name', 'AttValueList', 'AttValueAdd',]);
    }




//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     createData
//    public function createData() {
//        $save = 0;
//
//        $startFrom = 500;
//        $plus = 250;
//        $attribute_id = 5;
//        $lable = "جرام";
//        $lable_en = "Gram";
//
//        for ($i = 1; $i <= 7; $i++) {
//
//            $saveData = new AttributeValue();
//            $saveData->is_active = true;
//            $saveData->attribute_id = $attribute_id;
//            if ($save) {
//                $saveData->save();
//            }
//
//            $name = $startFrom . " " . $lable;
//            $name_en = $startFrom . " " . $lable_en;
//
//            $saveTranslation = AttributeValueTranslation::where('value_id', $saveData->id)->where('locale', 'ar')->firstOrNew();
//            $saveTranslation->locale = 'ar';
//            $saveTranslation->value_id = $saveData->id;
//            $saveTranslation->name = $name;
//            $saveTranslation->slug = AdminHelper::Url_Slug($name . " " . $attribute_id);
//            if ($save) {
//                $saveTranslation->save();
//            }
//
//            $saveTranslation = AttributeValueTranslation::where('value_id', $saveData->id)->where('locale', 'en')->firstOrNew();
//            $saveTranslation->locale = 'en';
//            $saveTranslation->value_id = $saveData->id;
//            $saveTranslation->name = $name_en;
//            $saveTranslation->slug = AdminHelper::Url_Slug($name_en . " " . $attribute_id);
//            if ($save) {
//                $saveTranslation->save();
//            }
//
//            echobr($name);
//            echobr($name_en);
//            $startFrom = $startFrom + $plus;
//        }
//
//    }

}



