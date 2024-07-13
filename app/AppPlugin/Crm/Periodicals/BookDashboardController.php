<?php

namespace App\AppPlugin\Crm\Periodicals;

use App\AppPlugin\Crm\Periodicals\Models\BooksTags;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsRelease;
use App\AppPlugin\Crm\Periodicals\Request\DashboardRequest;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use function Laravel\Prompts\select;


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
    public function Dashboard(Request $request, $id = null) {
        $releaseFilter = null;
        if ($id) {
            $releaseFilter = PeriodicalsRelease::query()
                ->where('id', intval($id))
                ->first();
        }

        $Periodicals = Periodicals::query()->get();

        $mostTags = BooksTags::query()->withCount('notes')->orderBy('notes_count','desc')->take(5)->get();


        $book = $Periodicals->count();
        $release = PeriodicalsRelease::query()->count();
        $tags = BooksTags::query()->count();
        $notes = PeriodicalsNotes::query()->count();
        $card = [];
        $card['bookCount'] = $book;
        $card['releaseCount'] = $release;
        $card['tagsCount'] = $tags;
        $card['notesCount'] = $notes;


        return view('AppPlugin.BookPeriodicals.dashbord.index')->with([
            'card' => $card,
            'Periodicals' => $Periodicals,
            'id' => $id,
            'releaseFilter' => $releaseFilter,
            'mostTags' => $mostTags,

        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function DashboardFilter(DashboardRequest $request) {
        $releaseFilter = self::ReleaseFilterQ(PeriodicalsRelease::query(), $request);
        if($releaseFilter->count() == 1){
            $sel = $releaseFilter->first();
            $par = $sel->id."?p=".$sel->periodicals_id."&y=".$sel->year."&m=".$sel->month."&n=".$sel->number ;
            return redirect()->route('admin.Dashboard.selRelease', $par);
        }else{
            $par = "no?p=".$request->periodicals_id."&y=".$request->year."&m=".$request->month."&n=".$request->number ;
            return redirect()->route('admin.Dashboard.selRelease', $par);
        }
    }


    static function ReleaseFilterQ($query, $request) {
        $query->where('periodicals_id', intval($request->input('periodicals_id')));
        $query->where('year', intval($request->input('year')));
        $query->where('month', intval($request->input('month')));
        if ($request->input('number')) {
            $query->where('number', intval($request->input('number')));
        }
        return $query;
    }


}
