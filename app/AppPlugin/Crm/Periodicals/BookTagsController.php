<?php

namespace App\AppPlugin\Crm\Periodicals;


use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Request\BookTagsRequest;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class BookTagsController extends AdminMainController {

    function __construct() {
        parent::__construct();
        $this->controllerName = "Periodicals";
        $this->PrefixRole = 'Periodicals';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/Periodicals.app_menu_tags');
        $this->PrefixRoute = $this->selMenu . $this->controllerName . ".BookTags";
        $this->tags = new BooksTags();
        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'configArr' => ["filterid" => 0, "orderbyPostion" => 1],
            'yajraTable' => true,
        ];
        self::loadConstructData($sendArr);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsIndex() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        return view('AppPlugin.BookPeriodicals.tags.index', compact('pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = $this->tags::findOrNew(0);
        return view('AppPlugin.BookPeriodicals.tags.form')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = $this->tags::where('id', $id)->firstOrFail();
        return view('AppPlugin.BookPeriodicals.tags.form')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsStoreUpdate
    public function TagsStoreUpdate(BookTagsRequest $request, $id = 0) {
        $saveData = $this->tags::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->name = $request->input('name');
                $saveData->save();
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsDelete($id) {
        $deleteRow = BooksTags::where('id', $id)->firstOrFail();
        try {
            DB::transaction(function () use ($deleteRow, $id) {
                $deleteRow->forceDelete();
            });
        } catch (\Exception $exception) {
            return back()->with(['confirmException' => '', 'fromModel' => 'Attribute', 'deleteRow' => $deleteRow]);
        }
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsDataTable(Request $request) {
        if ($request->ajax()) {
            $data = self::TagsindexQuery();
            return self::TagsDataTableColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsindexQuery() {
        $data = BooksTags::query()->withCount('notes');
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsDataTableColumns($data, $arr = array()) {
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })

            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'is_active']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsSearch(Request $request) {
        if (!empty($_GET['type']) && $_GET['type'] == 'TagsSearch') {
            $search = $request->search;
            $tags = BooksTags::orderby('name', 'asc')
                ->select('id', 'name')
                ->where('name', 'like', '%' . $search . '%')
                ->limit(50)->get();
            $response = array();
            foreach ($tags as $tag) {
                $response[] = array("id" => $tag->id, "text" => $tag->name);
            }
            return response()->json($response);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsOnFly(Request $request) {
        $response = array('addDone' => false);
        if ($request->newTagData['newTag'] == true) {
            $name = $request->newTagData['text'];
            $slugCount = BooksTags::where('name', $name)->count();
            if ($slugCount == 0) {
                $addNewTag = new BooksTags();
                $addNewTag->name = $name;
                $addNewTag->save();
                $response = array('addDone' => true, 'id' => $addNewTag->id);
            }
        }
        return response()->json($response);
    }

}
