<?php

namespace App\AppPlugin\Crm\Periodicals;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Request\PeriodicalsRequest;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\DefCategoryTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class PeriodicalsController extends AdminMainController {

    use CrudTraits;
    use CrmCustomersConfigTraits;
    use DefCategoryTraits;

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

        $this->Config = self::defConfig();
        View::share('Config', $this->Config);

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
            'formName' => "CrmCustomersFilter",
        ];

        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $rowData = self::PeriodicalsFilter(self::indexQuery(), $session);
        return view('AppPlugin.BookPeriodicals.periodicals.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_add');

        $rowData = Periodicals::findOrNew(0);

        return view('AppPlugin.BookPeriodicals.periodicals.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $rowData = Periodicals::where('id', $id)->firstOrFail();

        return view('AppPlugin.BookPeriodicals.periodicals.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(PeriodicalsRequest $request, $id = 0) {
        $saveData = Periodicals::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->name = $request->input('name');
                $saveData->des = $request->input('des');
                $saveData->country_id = $request->input('country_id');
                $saveData->release_id = $request->input('release_id');
                $saveData->lang_id = $request->input('lang_id');
                $saveData->save();
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    static function indexQuery() {
        $data = Periodicals::select(
            [
                'book_periodicals.*',
                'data_country_translations.name as countryName',
                'releasetype.name as releaseName',
                'lang.name as langName',
            ])
            ->with('release')
            ->where('update', null)
            ->leftJoin('data_country_translations', function ($join) {
                $join->on('book_periodicals.country_id', '=', 'data_country_translations.country_id')
                    ->where('data_country_translations.locale', '=', 'ar');
            })
            ->leftJoin('config_data_translations as releasetype', function ($join) {
                $join->on('book_periodicals.release_id', '=', 'releasetype.data_id')
                    ->where('releasetype.locale', '=', 'ar');
            })
            ->leftJoin('config_data_translations as lang', function ($join) {
                $join->on('book_periodicals.lang_id', '=', 'lang.data_id')
                    ->where('lang.locale', '=', 'ar');
            })->withsum('release', 'repeat');

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::PeriodicalsFilter(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('countryName', function ($row) {
                return $row->country->name ?? '';
            })
            ->editColumn('countRell', function ($row) {
                return $row->release()->count() ?? '0';
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('AddRelease', function ($row) {
                return view('datatable.but')->with(['btype' => 'AddRelease', 'row' => $row])->render();
            })
            ->editColumn('ListRelease', function ($row) {
                return view('datatable.but')->with(['btype' => 'ListRelease', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'ListRelease', 'AddRelease']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function PeriodicalsFilter($query, $session, $order = null) {
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

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeleteException
    public function ForceDeleteException($id) {
        $deleteRow = Periodicals::query()->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Periodicals";
        $mainMenu->name = "admin/Periodicals.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "Periodicals_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("Periodicals.Notes");;
        $subMenu->url = "admin.Periodicals.Notes.index";
        $subMenu->name = "admin/Periodicals.app_menu_notes";
        $subMenu->roleView = "Periodicals_view";
        $subMenu->icon = "far fa-lightbulb";
        $subMenu->save();


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("Periodicals");;
        $subMenu->url = "admin.Periodicals.index";
        $subMenu->name = "admin/Periodicals.app_menu_list";
        $subMenu->roleView = "Periodicals_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Periodicals.Report.index|Periodicals.Report.filter";
        $subMenu->url = "admin.Periodicals.Report.index";
        $subMenu->name = "admin/Periodicals.app_menu_report";
        $subMenu->roleView = "Periodicals_view";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Periodicals.ReleaseReport.index|Periodicals.ReleaseReport.filter";
        $subMenu->url = "admin.Periodicals.ReleaseReport.index";
        $subMenu->name = "admin/Periodicals.app_menu_report_release";
        $subMenu->roleView = "Periodicals_view";
        $subMenu->icon = "fas fa-chart-pie";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BookTags.index|BookTags.edit|BookTags.create|BookTags.config";
        $subMenu->url = "admin.Periodicals.BookTags.index";
        $subMenu->name = "admin/Periodicals.app_menu_tags";
        $subMenu->roleView = "Periodicals_view";
        $subMenu->icon = "fas fa-hashtag";
        $subMenu->save();

    }

}
