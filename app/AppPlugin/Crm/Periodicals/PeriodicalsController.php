<?php

namespace App\AppPlugin\Crm\Periodicals;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersRequest;

use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\DefCategoryTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
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
            'AddConfig' => true,
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
        $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);

        return view('AppPlugin.BookPeriodicals.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }


    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     indexQuery
    static function indexQuery() {

        $data = Periodicals::select(
            [
                'book_periodicals.*',
//                'book_periodicals.name',
//                'book_periodicals.country_id',
                'data_country_translations.name as countryName',
                'config_data_translations.name as releaseName',
            ])
            ->with('release')
            ->leftJoin('data_country_translations', function ($join) {
                $join->on('book_periodicals.country_id', '=', 'data_country_translations.country_id')
                    ->where('data_country_translations.locale', '=', 'ar');
            })
            ->leftJoin('config_data_translations', function ($join) {
                $join->on('book_periodicals.release', '=', 'config_data_translations.data_id')
                    ->where('config_data_translations.locale', '=', 'ar');
            });
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);
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
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'is_active', 'Flag']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function CustomerDataFilterQ($query, $session, $order = null) {
        $formName = issetArr($session, "formName", null);

        if (isset($session['is_active']) and $session['is_active'] != null) {
            $query->where('is_active', $session['is_active']);
        }
        if (isset($session['evaluation_id']) and $session['evaluation_id'] != null) {
            $query->where('evaluation_id', $session['evaluation_id']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $query->where('country_id', $session['country_id']);
        }

        if (isset($session['city_id']) and $session['city_id'] != null) {
            $query->where('city_id', $session['city_id']);
        }

        if (isset($session['area_id']) and $session['area_id'] != null) {
            $query->where('area_id', $session['area_id']);
        }

        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_add');

        $rowData = CrmCustomers::findOrNew(0);
        $rowDataAdress = CrmCustomersAddress::query()->where('customer_id', 0)->firstOrNew();

        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'rowDataAdress' => $rowDataAdress,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $rowData = Periodicals::where('id', $id)->firstOrFail();

        return view('AppPlugin.BookPeriodicals.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,


        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(CrmCustomersRequest $request, $id = 0) {
        $saveData = CrmCustomers::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {

                $saveData = self::saveDefField($saveData, $request);
                $saveData->save();


                if ($this->Config['addCountry']) {
                    $addressId = intval($request->input('address_id'));
                    if ($addressId == 0) {
                        $saveAddress = new CrmCustomersAddress();
                        $saveAddress->is_default = true;
                        $saveAddress = self::saveAddressField($saveAddress, $saveData, $request);
                        if ($saveAddress->country_id == null) {
                            $saveAddress->country_id = Country::where('iso2', $request->input('countryCode_mobile'))->first()->id;
                        }
                        $saveAddress->save();
                    } else {
                        $saveAddress = CrmCustomersAddress::query()->where('id', $addressId)->firstOrFail();
                        $saveAddress = self::saveAddressField($saveAddress, $saveData, $request);
                        $saveAddress->save();
                    }
                }

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function saveDefField($saveData, $request) {
        $saveData->evaluation_id = $request->input('evaluation_id');
        $saveData->gender_id = $request->input('gender_id');

        $saveData->name = $request->input('name');
        $saveData->mobile = $request->input('mobile');
        $saveData->mobile_code = $request->input('countryCode_mobile');

        $saveData->mobile_2 = $request->input('mobile_2');
        if ($request->input('mobile_2')) {
            $saveData->mobile_2_code = $request->input('countryCode_mobile_2');
        }

        $saveData->phone = $request->input('phone');
        if ($request->input('phone')) {
            $saveData->phone_code = $request->input('countryCode_phone');
        }

        $saveData->whatsapp = $request->input('whatsapp');
        if ($request->input('whatsapp')) {
            $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
        }

        $saveData->email = $request->input('email');
        $saveData->notes = $request->input('notes');

        return $saveData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function saveAddressField($saveAddress, $saveData, $request) {
        $saveAddress->uuid = Str::uuid()->toString();
        $saveAddress->customer_id = $saveData->id;

        $saveAddress->country_id = $request->input('country_id');
        $saveAddress->city_id = $request->input('city_id');
        $saveAddress->area_id = $request->input('area_id');

        $saveAddress->address = $request->input('address');
        $saveAddress->floor = $request->input('floor');
        $saveAddress->post_code = $request->input('post_code');
        $saveAddress->unit_num = $request->input('unit_num');
        $saveAddress->latitude = $request->input('latitude');
        $saveAddress->longitude = $request->input('longitude');

        return $saveAddress;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeleteException
    public function ForceDeleteException($id) {

        $deleteRow = CrmCustomers::query()->where('id', $id)
            ->firstOrFail();
        $deleteRow->delete();


//        if ($deleteRow->orders_count == 0) {
//            try {
//                DB::transaction(function () use ($deleteRow, $id) {
//                    if (count($deleteRow->more_photos) > 0) {
//                        foreach ($deleteRow->more_photos as $del_photo) {
//                            AdminHelper::DeleteAllPhotos($del_photo);
//                        }
//                    }
//                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
//                    $deleteRow->forceDelete();
//                });
//            } catch (\Exception $exception) {
//                return back()->with(['confirmException' => '', 'fromModel' => 'Product', 'deleteRow' => $deleteRow]);
//            }
//        } else {
//            return back()->with(['confirmException' => '', 'fromModel' => 'Product', 'deleteRow' => $deleteRow]);
//        }

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
        $subMenu->sel_routs = setActiveRoute("Periodicals");;
        $subMenu->url = "admin.Periodicals.index";
        $subMenu->name = "admin/Periodicals.app_menu_list";
        $subMenu->roleView = "Periodicals_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();


    }

}
