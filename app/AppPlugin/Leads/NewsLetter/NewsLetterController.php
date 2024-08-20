<?php

namespace App\AppPlugin\Leads\NewsLetter;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;


class NewsLetterController extends AdminMainController {

    use CrudTraits;

    function __construct(NewsLetter $model) {

        parent::__construct();
        $this->controllerName = "NewsLetter";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/leadsNewsLetter.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddAction' => 0,
            'formName' => "NewsLetter",
        ];
        self::loadConstructData($sendArr);

        $permission = [
            'sub' => 'config_newsletter',
            'edit' => ['Sort'],
        ];
        self::loadPagePermission($permission);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $session = self::getSessionData($request);
        $rowData = self::NewsLetterFilter(self::indexQuery(), $session);

        return view('AppPlugin.LeadsNewsLetter.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function NewsLetterFilter($query, $session, $order = null) {
        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if ($order != null) {
            $orderBy = explode("|", $order);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::NewsLetterFilter(self::indexQuery(), $session);
            return self::TableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {
        $data = DB::table("leads_news_letters");
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return returnTableId($this->agent, $row);
            })
            ->editColumn('created_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->created_at)),
                    'timestamp' => strtotime($row->created_at)
                ];
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'photo', 'isActive', 'name']);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Export(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $session = Session::get($this->formName);

        $dwonLadeFile = Excel::download(new NewsLetterExport($request), 'newslette.xlsx');

//        $UpdateState = self::FilterQ(NewsLetter::query(), $session)->where('export', 0)->get();
//        foreach ($UpdateState as $update) {
//            $update->export = 1;
//            $update->save();
//        }
        return $dwonLadeFile;
    }


}
