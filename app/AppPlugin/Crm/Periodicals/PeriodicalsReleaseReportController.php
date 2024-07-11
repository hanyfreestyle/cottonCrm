<?php

namespace App\AppPlugin\Crm\Periodicals;


use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class PeriodicalsReleaseReportController extends AdminMainController {
    use ReportFunTraits;


    function __construct() {
        parent::__construct();
        $this->controllerName = "Periodicals";
        $this->PrefixRole = 'Periodicals';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/Periodicals.";
        View::share('defLang', $this->defLang);

        $PeriodicalsList = Periodicals::query()->get() ;
        View::share('PeriodicalsList', $PeriodicalsList);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName . ".Report";

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
            'formName' => "ReleaseReport",
        ];

        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();

        $session = self::getSessionData($request);
        $rowData = self::ReleaseFilterQ(self::indexQuery(), $session);

        $Years = $rowData->get()->groupBy('year')->toarray();
        $Month = $rowData->get()->groupBy('month')->toarray();

        $AllData = $rowData->count();
        $chartData['Years'] = self::ChartDataFromGroup($AllData, $Years,'عام');
        $chartData['Month'] = self::ChartDataFromDefCategory($AllData,'month',$Month,12 );

        return view('AppPlugin.BookPeriodicals.report_release')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'chartData' => $chartData,
            'rowData' => $rowData,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    static function indexQuery() {
        $table = "book_periodicals_release";
        $data = DB::table($table)
            ->select("$table.id as id",
                "$table.year  as year",
                "$table.month  as month",
            );
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function ReleaseFilterQ($query, $session, $order = null) {
        $formName = issetArr($session, "formName", null);

        if (isset($session['periodicals_id']) and $session['periodicals_id'] != null) {
            $query->wherein('periodicals_id', $session['periodicals_id']);
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
