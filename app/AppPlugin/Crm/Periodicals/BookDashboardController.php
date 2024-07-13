<?php

namespace App\AppPlugin\Crm\Periodicals;

use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class BookDashboardController extends AdminMainController {
//    use ReportFunTraits;


//    function __construct() {
//        parent::__construct();
//        $this->controllerName = "Periodicals";
//        $this->PrefixRole = 'Periodicals';
//        $this->selMenu = "admin.";
//        $this->PrefixCatRoute = "";
//        $this->defLang = "admin/Periodicals.";
//        View::share('defLang', $this->defLang);
//
//        $CashCountryList = self::CashCountryList();
//        View::share('CashCountryList', $CashCountryList);
//
//        $this->PageTitle = __($this->defLang . 'app_menu');
//        $this->PrefixRoute = $this->selMenu . $this->controllerName . ".Report";
//
//        $sendArr = [
//            'TitlePage' => $this->PageTitle,
//            'PrefixRoute' => $this->PrefixRoute,
//            'PrefixRole' => $this->PrefixRole,
//            'AddConfig' => false,
//            'AddAction' => false,
//            'configArr' => ["filterid" => 0],
//            'yajraTable' => true,
//            'AddLang' => false,
//            'restore' => 0,
//            'formName' => "CrmCustomersReportFilter",
//        ];
//
//        self::loadConstructData($sendArr);
//
//        $this->middleware('permission:' . $this->PrefixRole . '_report', ['only' => ['report']]);

//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function Dashboard(Request $request) {
        $card = [];


        $book = Periodicals::query()->count();
        $release = PeriodicalsRelease::query()->count();
        $tags = BooksTags::query()->count();
        $notes = PeriodicalsNotes::query()->count();
        $card['bookCount'] = $book;
        $card['releaseCount'] = $release;
        $card['tagsCount'] = $tags;
        $card['notesCount'] = $notes;


        return view('AppPlugin.BookPeriodicals.dashbord')->with([
            'card'=>$card,

        ]);
    }

}
