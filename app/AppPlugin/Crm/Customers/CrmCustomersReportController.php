<?php

namespace App\AppPlugin\Crm\Customers;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CrmCustomersReportController extends AdminMainController {
    use ReportFunTraits;
    use CrmCustomersConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmCustomer";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm_customer.";
        View::share('defLang', $this->defLang);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

        $this->Config = self::defConfig();
        View::share('Config', $this->Config);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName . ".Report";

        $this->modelChart = CrmCustomers::class;
        View::share('modelChart', $this->modelChart);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddAction' => false,
            'formName' => "CrmCustomersReportFilter",
        ];

        self::constructData($sendArr);
        $permission = ['sub' => 'crm_customer_report'];
        self::loadPagePermission($permission);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $chartData = array();

        $session = self::getSessionData($request);
        $rowData = CrmCustomersController::CustomerDataFilterQ(self::indexQuery(), $session);
        $getData = $rowData->get();

        $evaluationId = $getData->groupBy('evaluation_id')->toarray();
        $CountryId = $getData->groupBy('country_id')->toarray();
        $CityId = $getData->groupBy('city_id')->toarray();
        $AreaId = $getData->groupBy('area_id')->toarray();
        $GenderId = $getData->groupBy('gender_id')->toarray();

        $AllData = $rowData->count();
        $chartData['Evaluation'] = self::ChartDataFromDataConfig($AllData, 'EvaluationCust', $evaluationId);
        $chartData['Gender'] = self::ChartDataFromDefCategory($AllData, 'gender', $GenderId);

        if ($this->Config['addCountry']) {
            $chartData['Country'] = self::ChartDataFromModel($AllData, Country::class, $CountryId);
            $chartData['City'] = self::ChartDataFromModel($AllData, City::class, $CityId);
            $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, $AreaId);
        }

        $weekChart = self::getChartWeek($rowData);
        $monthChart = self::getChartMonth($rowData);

        View::share('chartData', $chartData);
        View::share('session', $session);

        return view('AppPlugin.CrmCustomer.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'rowData' => $rowData,
            'weekChart' => $weekChart,
            'monthChart' => $monthChart,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {
        $table = "crm_customers";
        $table_address = "crm_customers_address";
        $data = DB::table($table)
            ->Join($table_address, $table . '.id', '=', $table_address . '.customer_id')
            ->where($table_address . '.is_default', true)
            ->select("$table.id as id",
                "$table.created_at  as created_at",
                "$table.evaluation_id  as evaluation_id",
                "$table.gender_id  as gender_id",
                "$table_address.country_id as country_id",
                "$table_address.city_id as city_id",
                "$table_address.area_id as area_id",
            );
        return $data;
    }

}
