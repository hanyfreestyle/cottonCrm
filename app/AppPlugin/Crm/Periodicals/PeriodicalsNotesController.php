<?php

namespace App\AppPlugin\Crm\Periodicals;


use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Crm\Periodicals\Request\BookNotesRequest;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class PeriodicalsNotesController extends AdminMainController {

    function __construct() {
        parent::__construct();
        $this->controllerName = "Periodicals";
        $this->PrefixRole = 'Periodicals';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/Periodicals.";
        View::share('defLang', $this->defLang);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName . ".Notes";

        $PeriodicalsList = Periodicals::query()->get();
        View::share('PeriodicalsList', $PeriodicalsList);

        $this->PrefixTags = "admin.Periodicals";
        View::share('PrefixTags', $this->PrefixTags);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddAction' => false,
            'configArr' => ["filterid" => 0],
            'yajraTable' => true,
            'AddLang' => false,
            'restore' => 0,
            'formName' => "PeriodicalsNotesFilter",
        ];

        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . 'notes_list');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $rowData = self::PeriodicalsNotesFilter(self::indexQuery(), $session);
        $tags = BooksTags::where('id', '!=', 0)->take(100)->get();

        return view('AppPlugin.BookPeriodicals.notes.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'tags' => $tags,
            'getSession' => Session::get($this->formName),
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function SelRelease() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = PeriodicalsNotes::findOrNew(0);

        $tags = BooksTags::where('id', '!=', 0)->take(100)->get();
        $selTags = [];

        return view('AppPlugin.BookPeriodicals.notes.sel_release')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
                'tags' => $tags,
                'selTags' => $selTags,
            ]
        );
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function NotesCreate($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Release = PeriodicalsRelease::where('id', $id)->with('periodicals')->firstOrFail();
        $rowData = PeriodicalsNotes::findOrNew(0);

        $tags = BooksTags::where('id', '!=', 0)->take(100)->get();
        $selTags = [];

        return view('AppPlugin.BookPeriodicals.notes.form')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
                'tags' => $tags,
                'selTags' => $selTags,
                'Release' => $Release,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function NotesEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = PeriodicalsNotes::where('id', $id)->firstOrFail();
        $Release = PeriodicalsRelease::where('id', $rowData->periodicals_id)->with('periodicals')->firstOrFail();

        $tags = BooksTags::where('id', '!=', 0)->take(100)->get();
        $selTags = $rowData->tags()->pluck('tag_id')->toArray();
        return view('AppPlugin.BookPeriodicals.notes.form')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
                'tags' => $tags,
                'selTags' => $selTags,
                'Release' => $Release,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function NotesStoreUpdate(BookNotesRequest $request, $id = 0) {
        $saveData = PeriodicalsNotes::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $tags = $request->input('tag_id');
                $saveData->periodicals_id = $request->input('periodicals_id');
                $saveData->name = $request->input('name');
                $saveData->page_num = $request->input('page_num');
                $saveData->author = $request->input('author');
                $saveData->des = $request->input('des');
                $saveData->save();
                $saveData->tags()->sync($tags);
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return redirect()->route($this->PrefixRoute . '.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function DeleteNotes($id) {
        $deleteRow = PeriodicalsNotes::where('id', $id)->firstOrFail();
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
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    static function indexQuery() {
        $data = PeriodicalsNotes::query()->with('tags')->with('release');
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::PeriodicalsNotesFilter(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('releaseName', function ($row) {
                $periodicals = $row->release->periodicals->name ?? '';
                $release_year = $row->release->year ?? '';
                $release_month = $row->release->month ?? '';
                $release_number = $row->release->number ?? '';
                $release = "";
                if ($release_year) {
                    $release .= " " . $release_year;
                }
                if ($release_month) {
                    $release .= " شهر " . $release_month;
                }
                if ($release_number) {
                    $release .= " العدد " . $release_number;
                }

                $printName = $periodicals . " " . $release;
                if($row->author){
                    $printName .= '</br>'.__('admin/Periodicals.notes_author')." : ".$row->author;
                }

                if(intval($row->page_num)>0){
                    $printName .= '</br>'.__('admin/Periodicals.notes_page_num')." : ".$row->page_num;
                }

                return $printName;

            })
            ->addColumn('TagsName', function ($row) {
                return view('datatable.but')->with(['btype' => 'TagsName', 'row' => $row])->render();
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->editColumn('created_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->created_at)),
                    'timestamp' => strtotime($row->published_at)
                ];
            })
            ->rawColumns(['Edit', "Delete", 'ListRelease', 'TagsName', 'releaseName']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function PeriodicalsNotesFilter($query, $session, $order = null) {
        $formName = issetArr($session, "formName", null);

        if (isset($session['tag_id']) and $session['tag_id'] != null) {
            $tagId = $session['tag_id'];
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tag_id', $tagId);
            });
        }
        return $query;
    }

}
