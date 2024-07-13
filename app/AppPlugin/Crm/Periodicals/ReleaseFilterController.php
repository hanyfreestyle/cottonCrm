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
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class ReleaseFilterController extends AdminMainController {

    function __construct() {
        parent::__construct();
        $this->controllerName = "Periodicals";
        $this->PrefixRole = 'Periodicals';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/Periodicals.";
        View::share('defLang', $this->defLang);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName . ".ReleaseFilter";

//        dd($this->PrefixRoute);

        $PeriodicalsList = Periodicals::query()->get();
        View::share('PeriodicalsList', $PeriodicalsList);

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
            'AddButToCard' => false,
            'formName' => "ReleaseFilter",
        ];

        self::loadConstructData($sendArr);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function SelRelease(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $session = self::getSessionData($request);
        if (isset($session)) {
            $rowData = self::ReleaseFilter(self::indexQuery(), $session)->get();
        } else {
            $rowData = PeriodicalsRelease::query()->where('id', 0)->get();
        }
        return view('AppPlugin.BookPeriodicals.notes.sel_release')->with(
            [
                'pageData' => $pageData,
                'rowData' => $rowData,
            ]
        );
    }

    static function indexQuery() {
         return PeriodicalsRelease::query()->with('periodicals') ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function ReleaseFilter($query, $session, $order = null) {

        $formName = issetArr($session, "formName", null);

        if (isset($session['periodicals_id']) and $session['periodicals_id'] != null) {
            $query->where('periodicals_id', $session['periodicals_id']);
        }else{
            $query->where('periodicals_id', 0);
        }

        if (isset($session['year']) and $session['year'] != null) {
            $query->where('year', $session['year']);
        }

        if (isset($session['month']) and $session['month'] != null) {
            $query->where('month', $session['month']);
        }

        return $query;
    }

}
