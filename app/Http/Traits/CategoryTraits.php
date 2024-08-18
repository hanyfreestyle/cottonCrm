<?php

namespace App\Http\Traits;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

trait CategoryTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategoryIndex($id = null) {

        if (!IsConfig($this->config, 'TableCategory')) {
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $trees = [];
        $route = '.DataTable';
        if (IsConfig($this->config, 'categoryTree')) {
            if (Route::currentRouteName() == $this->PrefixRoute . '.index_Main') {
                $route = '.DataTableMain';
            } elseif (Route::currentRouteName() == $this->PrefixRoute . '.SubCategory') {
                $trees = $this->model->find($id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();
                $pageData['SubView'] = true;
                $route = '.DataTableSub';
            }
        }
        return view('admin.mainView.category.index')->with([
            'pageData' => $pageData,
            'trees' => $trees,
            'route' => $route,
            'id' => $id,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategoryCreate() {
        if (!IsConfig($this->config, 'TableCategory')) {
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $LangAdd = self::getAddLangForAdd();

        $rowData = $this->model->findOrNew(0);

        return view('admin.mainView.category.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'LangAdd' => $LangAdd,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategoryEdit($id) {
        if (!IsConfig($this->config, 'TableCategory')) {
            abort(403);
        }

        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->model->findOrFail($id);
        $LangAdd = self::getAddLangForEdit($rowData);
        return view('admin.mainView.category.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'LangAdd' => $LangAdd,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $rowData = self::categoryIndexQuery($this->config);
            return self::CategoryColumns($rowData)->make(true);
        }
    }

    public function DataTableMain(Request $request) {
        if ($request->ajax()) {
            $rowData = self::categoryIndexQuery($this->config, 'main');
            return self::CategoryColumns($rowData)->make(true);
        }
    }

    public function DataTableSub(Request $request, $id) {
        if ($request->ajax()) {
            $rowData = self::categoryIndexQuery($this->config, 'sub', $id);
            return self::CategoryColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function categoryIndexQuery($config, $route = 'all', $id = null) {

        $table = $config['DbCategory'];
        $table_trans = $config['DbCategoryTrans'];

        $data = DB::table("$table");

        if ($route == 'main') {
            $data->where("$table.parent_id", null);
        }
        if ($route == 'sub') {
            $data->where("$table.parent_id", $id);
        }

        $data->leftJoin("$table as childCount", "$table.id", '=', 'childCount.parent_id')
            ->join("$table_trans", "$table.id", '=', "$table_trans.category_id")
            ->where("$table_trans.locale", '=', dataTableDefLang())
            ->select(
                "$table.id as id",
                "$table.is_active as is_active",
                "$table.photo_thum_1 as photo",
                "$table_trans.name as name",
                DB::raw('COUNT(childCount.id) as child_count')
            )
            ->groupBy(
                "$table.id",
                "$table.is_active",
                "$table.photo_thum_1",
                "$table_trans.name"
            );

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategoryColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('name', function ($row) {
                if (IsConfig($this->config, 'categoryTree')) {
                    if ($row->child_count == 0) {
                        return $row->name;
                    } else {
                        return '<a href="' . route($this->PrefixRoute . ".SubCategory", $row->id) . '">' . $row->name . ' (' . $row->child_count . ')</a>';
                    }
                } else {
                    return $row->name;
                }
            })
            ->editColumn('photo', function ($row) {
                return TablePhoto($row, 'photo');
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
            ->rawColumns(['Edit', "Delete", 'photo', 'isActive', 'name']);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SetCatTree($categoryTree, $deep) {
        if ($categoryTree) {
            if (Route::currentRouteName() == $this->PrefixRoute . '.edit') {
                $thisId = intval(Route::current()->parameter('id'));
                $catChildren = $this->model->find($thisId)->descendantsAndSelf()->pluck('id')->toArray();
                $this->Categories = $this->model::tree($deep)->with('translations')->whereNotIn('id', $catChildren)->get()->toTree();
            } else {
                $this->Categories = $this->model::tree($deep)->get()->toTree();
            }
        } else {
            $this->Categories = [];
        }
        View::share('Categories', $this->Categories);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TraitsCategoryStoreUpdate($request, $id) {



        if (intval($id) == 0) {
            $saveData = $this->model->findOrNew($id);
        } else {
            $saveData = $this->model->findOrFail($id);
            if (IsConfig($this->config, 'categoryTree')) {
                $trees = $this->model->find($saveData->id)->descendants()->pluck('id')->toArray();
                if (in_array($request->input('parent_id'), $trees)) {
                    return back()->with('data_not_save', "");
                }
            }
        }

        try {
            DB::transaction(function () use ($request, $saveData) {
                if (IsConfig($this->config, 'categoryTree')) {
                    if ($request->input('parent_id') != 0 and $request->input('parent_id') != $saveData->id) {
                        $saveData->parent_id = $request->input('parent_id');
                        $saveData->deep = count($this->model->find($request->input('parent_id'))->ancestorsAndSelf()->pluck('id')->toArray());
                    }
                }
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->updated_at = getCurrentTime();
                $saveData->save();


                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'en.name');

                if (IsConfig($this->config, 'categoryIcon')) {
                    $saveImgData_icon = new PuzzleUploadProcess();
                    $saveImgData_icon->setUploadDirIs($this->UploadDirIs . '/' . $saveData->id);
                    $saveImgData_icon->setnewFileName($request->input('en.slug'));
                    $saveImgData_icon->setfileUploadName('icon');
                    $saveImgData_icon->UploadOne($request, "IconFilter");
                    $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData_icon, 'icon');
                    $saveData->save();
                }

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $dbName = $this->DbCategoryForeign;
                    $saveTranslation = $this->translation->where($dbName, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$dbName = $saveData->id;
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }

                if (IsConfig($this->config, 'categoryTree')) {
                    if ($saveData->is_active == false) {
                        $trees = $this->model->find($saveData->id)->descendants()->pluck('id')->toArray();
                        if (count($trees) > 0) {
                            $this->model->whereIn("id", $trees)->update(['is_active' => 0]);
                        }
                    }
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
    public function CategorySort($id) {

        if (!IsConfig($this->config, 'TableCategory') or !IsConfig($this->config, 'categorySort')) {
            abort(403);
        }
        $pageData = $this->pageData;

        $pageData['ViewType'] = "List";
        $thisRow = null;
        if ($id == 0) {
            $rowData = $this->model->where('parent_id', null)->orderBy('position')->get();
        } else {
            $thisRow = $this->model->findOrFail($id);
            $rowData = $this->model->where('parent_id', $thisRow->id)->orderBy('position')->get();;
        }

        return view('admin.mainView.category.sort', compact('pageData', 'rowData', 'thisRow'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategorySaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = $this->model->findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategoryConfig() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if ($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config_category", compact('pageData'));
        }
    }

}
