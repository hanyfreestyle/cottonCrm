<?php

namespace App\AppPlugin\Crm\Periodicals;


use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
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
    public function TagsDataTable(Request $request) {
        if ($request->ajax()) {
            $data = self::TagsindexQuery();
            return self::TagsDataTableColumns($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsindexQuery() {
        $table = "book_tags";
        $data = DB::table($table)
            ->select("$table.id as id",
                "$table.name as name",
            );
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function TagsDataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
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
    public function TagsDelete($id) {
        $deleteRow = $this->tags::where('id', $id)->firstOrFail();
        try {
            DB::transaction(function () use ($deleteRow, $id) {
                $deleteRow->forceDelete();
            });
        } catch (\Exception $exception) {
            return back()->with(['confirmException' => '', 'fromModel' => 'Attribute', 'deleteRow' => $deleteRow]);
        }
        return back()->with('confirmDelete', "");
    }

    /*


    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #   TagsSearch
        public function TagsSearch(Request $request) {
            if (!empty($_GET['type']) && $_GET['type'] == 'TagsSearch') {
                $search = $request->search;
                $tags = $this->tagsTranslation::orderby('name', 'asc')
                    ->select('id', 'name', 'tag_id')
                    ->where('locale', thisCurrentLocale())
                    ->where('name', 'like', '%' . $search . '%')
                    ->limit(50)->get();
                $response = array();
                foreach ($tags as $tag) {
                    $response[] = array("id" => $tag->tag_id, "text" => $tag->name);
                }
                return response()->json($response);
            }
        }

    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| # TagsOnFly
        public function TagsOnFly(Request $request) {
            $response = array('addDone' => false);
            if ($request->newTagData['newTag'] == true) {
                $slug = AdminHelper::Url_Slug($request->newTagData['text']);
                $slugCount = $this->tagsTranslation::where('slug', $slug)->count();
                if ($slugCount == 0) {
                    $addNewTag = $this->tags;
                    $addNewTag->save();
                    foreach (config('app.web_lang') as $key => $lang) {
                        $newTranslation = $this->tagsTranslation::where('id', 0)->firstOrNew();
                        $newTranslation->tag_id = $addNewTag->id;
                        $newTranslation->locale = $key;
                        $newTranslation->slug = $slug;
                        $newTranslation->name = $request->newTagData['text'];
                        $newTranslation->save();
                    }
                    $response = array('addDone' => true, 'id' => $addNewTag->id);
                }
            }
            return response()->json($response);
        }

   */


}
