<?php

namespace App\AppPlugin\Config\Meta;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MetaTagController extends AdminMainController {

    use CrudTraits;

    function __construct(MetaTag $model) {

        parent::__construct();
        $this->controllerName = "Meta";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/configMeta.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
        ];

        self::loadConstructData($sendArr);
        $permission = [
            'sub' => 'config_meta_view',
        ];
        self::loadPagePermission($permission);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('WebMeta_Cash');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
//        $rowData = self::indexQuery();
//        dd($rowData->get());
        return view('AppPlugin.ConfigMeta.index')->with([
            'pageData' => $pageData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $data = self::indexQuery();
            return self::DataTableColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->addColumn('photo', function ($row) {
                return TablePhoto($row, 'photo');
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'photo']);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery() {
        $table = "config_meta_tag";
        $table_trans = "config_meta_tag_translations";
        $data = DB::table($table)
            ->Join($table_trans, $table . '.id', '=', $table_trans . '.meta_tag_id')
            ->where($table_trans . '.locale', '=', self::DataTableDefLang())
            ->select(
                "$table.id as id",
                "$table.cat_id as cat_id",
                "$table.photo_thum_1 as photo",
                "$table_trans.name as name",
                "$table_trans.g_title as  title",
                "$table_trans.g_des as des",
            );
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = new MetaTag();
        return view('AppPlugin.ConfigMeta.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = MetaTag::findOrFail($id);
        return view('AppPlugin.ConfigMeta.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function storeUpdate(MetaTagRequest $request, $id = '0') {
        try {
            DB::transaction(function () use ($request, $id) {

                $saveData = MetaTag::findOrNew($id);
                $saveData->cat_id = AdminHelper::Url_Slug($request->input('cat_id'), ['delimiter' => '_']);
                $saveData->save();
                self::SaveAndUpdateDefPhoto($saveData, $request, 'meta', 'cat_id');

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = MetaTagTranslation::where('meta_tag_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->meta_tag_id = $saveData->id;
                    $saveTranslation->locale = $key;
                    $saveTranslation->g_title = $request->input($key . '.g_title');
                    $saveTranslation->g_des = $request->input($key . '.g_des');
                    if (config('AppPlugin.Meta.name')) {
                        $saveTranslation->name = $request->input($key . '.name');
                        $saveTranslation->des = $request->input($key . '.des');
                    }
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

}
