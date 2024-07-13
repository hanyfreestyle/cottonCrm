<?php

namespace App\AppPlugin\Crm\Periodicals;


use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Crm\Periodicals\Request\PeriodicalsAddReleaseRequest;
use App\AppPlugin\Crm\Periodicals\Request\PeriodicalsAddReleaseYearsRequest;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\DefCategoryTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class PeriodicalsReleaseController extends AdminMainController {
    use CrudTraits;
    use DefCategoryTraits;

    function __construct() {

        parent::__construct();
        $this->controllerName = "PeriodicalsRelease";
        $this->PrefixRole = 'Periodicals';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/Periodicals.";
        View::share('defLang', $this->defLang);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

        $this->DefCat = self::LoadCategory();
        View::share('DefCat', $this->DefCat);


        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'configArr' => ["filterid" => 0],
            'yajraTable' => true,
            'AddLang' => false,
            'restore' => 0,
            'AddButToCard' => false,
            'formName' => "CrmCustomersFilter",
        ];
        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function ListRelease(Request $request, $periodicalsId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $book = Periodicals::where('id', $periodicalsId)->withcount('release')->firstOrFail();

        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list_release') . ' (' . $book->name . ')';
        $pageData['SubView'] = false;
        $session = self::getSessionData($request);
        $rowData = self::ReleaseFilterQ(self::indexQuery($periodicalsId), $session);

        return view('AppPlugin.BookPeriodicals.release.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'periodicalsId' => $periodicalsId,
            'book' => $book,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AddRelease($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Periodicals = Periodicals::query()->where('id', $id)->withCount('release')->withsum('release', 'repeat')->firstOrFail();
        $PeriodicalsRelease = new PeriodicalsRelease();
        $pageData['BoxH1'] = __('admin/Periodicals.app_menu_add_release');

        return view('AppPlugin.BookPeriodicals.release.form')->with([
            'pageData' => $pageData,
            'Periodicals' => $Periodicals,
            'PeriodicalsRelease' => $PeriodicalsRelease,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function EditRelease($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $pageData['BoxH1'] = __('admin/Periodicals.app_menu_edit_release');
        $PeriodicalsRelease = PeriodicalsRelease::where('id', $id)->firstOrFail();
        $Periodicals = Periodicals::query()
            ->where('id', $PeriodicalsRelease->periodicals_id)
            ->withCount('release')->firstOrFail();

        return view('AppPlugin.BookPeriodicals.release.form')->with([
            'pageData' => $pageData,
            'Periodicals' => $Periodicals,
            'PeriodicalsRelease' => $PeriodicalsRelease,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AddEditOneRelease(PeriodicalsAddReleaseRequest $request, $id) {
        $saveData = PeriodicalsRelease::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->periodicals_id = $request->input('periodicals_id');
                $saveData->year = $request->input('year');
                $saveData->month = $request->input('month');
                $saveData->number = $request->input('number');
                $saveData->notes = $request->input('notes');
                $saveData->repeat = $request->input('repeat');
                $saveData->save();
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        if ($id == 0) {
            return back()->with('Add.Done', "");
        } else {
            return back()->with('Edit.Done', "");
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AddReleaseYears($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Periodicals = Periodicals::query()->where('id', $id)->withCount('release')->withsum('release', 'repeat')->firstOrFail();
        $PeriodicalsRelease = new PeriodicalsRelease();
        $pageData['BoxH1'] = __('admin/Periodicals.but_add_year_list');

        //        dd($Periodicals->release->groupBy('year') );
        return view('AppPlugin.BookPeriodicals.form_AddReleaseYears')->with([
            'pageData' => $pageData,
            'Periodicals' => $Periodicals,
            'PeriodicalsRelease' => $PeriodicalsRelease,
        ]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function DeleteRelease($id) {
        $deleteRow = PeriodicalsRelease::query()->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        return back()->with('confirmDelete', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ReleaseDeleteAll($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $Periodicals = Periodicals::query()->where('id', $id)->withCount('release')->firstOrFail();
        $PeriodicalsRelease = new PeriodicalsRelease();
        $pageData['BoxH1'] = __('admin/Periodicals.app_menu_add_release');

        return view('AppPlugin.BookPeriodicals.release.delete_all')->with([
            'pageData' => $pageData,
            'Periodicals' => $Periodicals,
            'PeriodicalsRelease' => $PeriodicalsRelease,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ReleaseDeleteAllConfirm($id) {
        $Periodicals = Periodicals::query()->where('id', $id)->firstOrFail();
        $deleteRow = PeriodicalsRelease::query()->where('periodicals_id', $Periodicals->id)->delete();
        //        $deleteRow->delete();
        return redirect()->route('admin.Periodicals.ListRelease', $Periodicals->id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AddYearReleaseForm(PeriodicalsAddReleaseYearsRequest $request, $id) {
        $periodicals_id = $request->input('periodicals_id');
        $Periodicals = Periodicals::query()->where('id', $periodicals_id)->firstOrFail();
        if (count($request->yearslist) >= 1) {
            try {
                DB::transaction(function () use ($request) {
                    foreach ($request->yearslist as $key => $value) {
                        $PeriodicalsRelease = new PeriodicalsRelease();
                        $PeriodicalsRelease->periodicals_id = $request->input('periodicals_id');
                        $PeriodicalsRelease->year = $request->input('year');
                        $PeriodicalsRelease->month = $value;
                        $PeriodicalsRelease->number = $value;
                        $PeriodicalsRelease->notes = $request->input('notes_' . $value);
                        $PeriodicalsRelease->repeat = $request->input('repeat_' . $value);
                        $PeriodicalsRelease->save();
                    }
                });
            } catch (\Exception $exception) {
                return back()->with('data_not_save', "");
            }

            return back()->with('Add.Done', "");
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function ReleaseDataTable(Request $request, $periodicalsId) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::ReleaseFilterQ(self::indexQuery($periodicalsId), $session);
            return self::ReleaseTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function ReleaseTableColumns($data, $arr = array()) {
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'ListRelease', 'AddRelease']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    static function indexQuery($id) {
        $data = PeriodicalsRelease::query()->where('periodicals_id', $id)
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC');
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function ReleaseFilterQ($query, $session, $order = null) {
        $formName = issetArr($session, "formName", null);

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $query->where('book_periodicals.country_id', $session['country_id']);
        }

        if (isset($session['release_id']) and $session['release_id'] != null) {
            $query->where('release_id', $session['release_id']);
        }

        if (isset($session['lang_id']) and $session['lang_id'] != null) {
            $query->where('lang_id', $session['lang_id']);
        }

        return $query;
    }

}
