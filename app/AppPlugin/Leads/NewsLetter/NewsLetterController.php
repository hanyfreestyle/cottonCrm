<?php

namespace App\AppPlugin\Leads\NewsLetter;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


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
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, "datatable" => 0, 'orderbyName' => 0, "orderbyDate" => 1],
            'restore' => 0,
            'AddAction' => 0,
            'formName' => "NewsLetter",
        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:' . $this->PrefixRole . '_defPhoto_view', ['only' => ['index']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # index
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $session = self::getSessionData($request);

        if($session == null) {
            $rowData = self::getSelectQuery(NewsLetter::query());
        } else {
            $rowData = self::getSelectQuery(self::FilterQ(NewsLetter::query(), $session));
        }

        return view('AppPlugin.LeadsNewsLetter.index', compact('pageData', 'rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Export
    public function Export(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $session = Session::get($this->formName);

        $dwonLadeFile = Excel::download(new NewsLetterExport($request), 'newslette.xlsx');

        $UpdateState = self::FilterQ(NewsLetter::query(), $session)->where('export', 0)->get();
        foreach ($UpdateState as $update) {
            $update->export = 1;
            $update->save();
        }
        return $dwonLadeFile;
    }


}
