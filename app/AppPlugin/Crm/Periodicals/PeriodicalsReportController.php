<?php

namespace App\AppPlugin\Crm\Periodicals;


use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class PeriodicalsReportController extends AdminMainController {
    use ReportFunTraits;


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
            'formName' => "CrmCustomersReportFilter",
        ];

        self::loadConstructData($sendArr);

        $this->middleware('permission:' . $this->PrefixRole . '_report', ['only' => ['report']]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();

        $session = self::getSessionData($request);
        $rowData = PeriodicalsController::PeriodicalsFilter(self::indexQuery(), $session);

        $CountryId = $rowData->get()->groupBy('country_id')->toarray();
        $ReleaseId = $rowData->get()->groupBy('release_id')->toarray();
        $LangId = $rowData->get()->groupBy('lang_id')->toarray();

        $AllData = $rowData->count();
        $chartData['Country'] = self::ChartDataFromModel($AllData, Country::class, $CountryId);
        $chartData['Release'] = self::ChartDataFromDataConfig($AllData, 'BookRelease', $ReleaseId);
        $chartData['BookLang'] = self::ChartDataFromDataConfig($AllData, 'BookLang', $LangId);

        return view('AppPlugin.BookPeriodicals.report.periodicals')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'chartData' => $chartData,
            'rowData' => $rowData,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    static function indexQuery() {
        $table = "book_periodicals";
        $data = DB::table($table)
            ->select("$table.id as id",
                "$table.country_id  as country_id",
                "$table.release_id  as release_id",
                "$table.lang_id  as lang_id",
            );
        return $data;
    }

}
