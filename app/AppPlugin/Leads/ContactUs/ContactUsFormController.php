<?php

namespace App\AppPlugin\Leads\ContactUs;

use App\AppCore\Menu\AdminMenu;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;


class ContactUsFormController extends AdminMainController {

    use CrudTraits;

    function __construct(ContactUsForm $model) {
        parent::__construct();
        $this->controllerName = "LeadsFrom";
        $this->PrefixRole = 'leads';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/leadsContactUs.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'restore' => 0,
            'AddAction' => 0,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, "datatable" => 0, 'orderbyName' => 0, "orderbyDate" => 1],
            'PageListUrl' => "#",
            'formName' => "LeadsFrom",
        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['indexAll']]);
        $this->middleware('permission:' . $this->PrefixRole . '_export', ['only' => ['Export']]);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   indexAll
    public function indexAll(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        if (Route::currentRouteName() == 'admin.LeadsFrom.ContactUs.index' or Route::currentRouteName() == 'admin.LeadsFrom.ContactUs.filter') {
            $this->formName = "LeadsFromContactUs";
            View::share('formName', $this->formName);
            View::share('PrefixRoute', "admin.LeadsFrom.ContactUs");
            $requestType = '1';
        } elseif (Route::currentRouteName() == 'admin.LeadsFrom.Request.index' or Route::currentRouteName() == 'admin.LeadsFrom.Request.filter') {
            $this->formName = "LeadsFromRequestCall";
            View::share('formName', $this->formName);
            View::share('PrefixRoute', "admin.LeadsFrom.Request");
            $requestType = '2';
        } elseif (Route::currentRouteName() == 'admin.LeadsFrom.Meeting.index' or Route::currentRouteName() == 'admin.LeadsFrom.Meeting.filter') {
            $this->formName = "LeadsFromMeeting";
            View::share('formName', $this->formName);
            View::share('PrefixRoute', "admin.LeadsFrom.Meeting");
            $requestType = '3';
        }

        $session = self::getSessionData($request);

        if ($session == null) {
            $rowData = self::getSelectQuery(ContactUsForm::where('request_type', $requestType));
        } else {

            $rowData = self::getSelectQuery(self::FilterQ(ContactUsForm::where('request_type', $requestType), $session));
        }

        return view('AppPlugin.LeadsContactUs.index', compact('pageData', 'rowData', 'requestType'));

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function Export(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        return Excel::download(new ContactUsFormExport($request), 'users.xlsx');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.LeadsFrom";
        $mainMenu->name = "admin/leadsContactUs.app_menu";
        $mainMenu->icon = "fas fa-phone-volume";
        $mainMenu->roleView = "leads_view";
        $mainMenu->save();

//        $subMenu = new AdminMenu();
//        $subMenu->parent_id = $mainMenu->id;
//        $subMenu->sel_routs = "Request.index";
//        $subMenu->url = "admin.LeadsFrom.Request.index";
//        $subMenu->name = "admin/leadsContactUs.app_menu_requst";
//        $subMenu->roleView = "leads_view";
//        $subMenu->icon = "fas fa-phone-square";
//        $subMenu->save();
//
//        $subMenu = new AdminMenu();
//        $subMenu->parent_id = $mainMenu->id;
//        $subMenu->sel_routs = "Meeting.index";
//        $subMenu->url = "admin.LeadsFrom.Meeting.index";
//        $subMenu->name = "admin/leadsContactUs.app_menu_meeting";
//        $subMenu->roleView = "leads_view";
//        $subMenu->icon = "fas fa-handshake";
//        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "ContactUs.index";
        $subMenu->url = "admin.LeadsFrom.ContactUs.index";
        $subMenu->name = "admin/leadsContactUs.app_menu_conatct";
        $subMenu->roleView = "leads_view";
        $subMenu->icon = "fas fa-mail-bulk";
        $subMenu->save();

    }


}


