<?php

namespace App\AppPlugin\Crm\Customers;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersRequest;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersSearchRequest;
use App\AppPlugin\Crm\Customers\Traits\CrmCustomersConfigTraits;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class CrmCustomersController extends AdminMainController {
    use CrudTraits;
    use CrmCustomersConfigTraits;


    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmCustomer";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);

        $this->config = self::defConfig();
        View::share('config', $this->config);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'AddLang' => false,
            'restore' => 0,
            'formName' => "CrmCustomersFilter",
        ];

        self::constructData($sendArr);
        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['search']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);

        return view('AppPlugin.CrmCustomer.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function indexQuery() {

        $table = "crm_customers";
        $table_address = "crm_customers_address";
        $dataTable = 'config_data_translations';
        $data = DB::table($table)
            ->Join($table_address, $table . '.id', '=', $table_address . '.customer_id')
            ->where($table_address . '.is_default', true)
            ->leftJoin("config_data_translations", function ($join) {
                $join->on('crm_customers.evaluation_id', '=', 'config_data_translations.data_id');
                $join->where('config_data_translations.locale', '=', 'ar');
            })
            ->select("$table.id as id",
                "$table.name  as name",
                "$table.mobile  as mobile",
                "$table.mobile_code  as flag",
                "$table.whatsapp  as whatsapp",
                "$table.evaluation_id  as evaluation_id",
                "$table_address.country_id as country_id",
                "$table_address.city_id as city_id",
                "$table_address.area_id as area_id",
                "$dataTable.name as evaluation",
            );
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CustomerDataFilterQ($query, $session, $order = null) {

        if (isset($session['evaluation_id']) and $session['evaluation_id'] != null) {
            $query->where('evaluation_id', $session['evaluation_id']);
        }

        if (isset($session['gender_id']) and $session['gender_id'] != null) {
            $query->where('gender_id', $session['gender_id']);
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
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                if ($this->agent->isDesktop()) {
                    return $row->id;
                } else {
                    return null;
                }

            })
            ->editColumn('Flag', function ($row) {
                return TablePhotoFlag_Code($row, 'flag');
            })
            ->editColumn('addTicket', function ($row) {
                return view('datatable.but')->with(['btype' => 'addTicket', 'row' => $row])->render();
            })
            ->editColumn('Profile', function ($row) {
                return view('datatable.but')->with(['btype' => 'Profile', 'row' => $row])->render();
            })
            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'Profile', 'Flag', 'addTicket']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        View::share('FormType', $pageData['ViewType']);
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_add');

        $rowData = CrmCustomers::findOrNew(0);
        $rowDataAddress = CrmCustomersAddress::query()->where('customer_id', 0)->firstOrNew();

        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'rowDataAddress' => $rowDataAddress,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        View::share('FormType', $pageData['ViewType']);

        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $rowData = CrmCustomers::where('id', $id)->with('address')->firstOrFail();

        $rowDataAddress = CrmCustomersAddress::where('is_default', true)->where('customer_id', $rowData->id)->firstOrNew();

        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'rowDataAddress' => $rowDataAddress,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
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




/*


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function repeat($value) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "repeat";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_repeat');

        $rowData = CrmCustomers::def()->where('mobile', $value)->orWhere('mobile_2', $value)
            ->orWhere('phone', $value)->orWhere('whatsapp', $value)->get();

        return view('AppPlugin.CrmCustomer.repeat')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }









#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function profile($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = CrmCustomers::where('id', $id)->with('address')->firstOrFail();
        return view('AppPlugin.CrmCustomer.profile')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }
















#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ForceDeleteException($id) {

//        $deleteRow = CrmCustomers::query()->where('id', $id)
//            ->firstOrFail();
//        $deleteRow->delete();


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
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function search() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $rowData = CrmCustomers::query()->where('id', 0)->get();
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => false,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function searchFilter(CrmCustomersSearchRequest $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "search";
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_search');
        $pageData['BoxH2'] = __($this->defLang . 'app_menu_search_results');

        $rowData = self::CustomersSearchFilter($request);
        return view('AppPlugin.CrmCustomer.search')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'nodata' => true,
            'request' => $request,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CustomersSearchFilter($request) {
        if ($request->search_type == 1) {
            $rowData = CrmCustomers::query()
                ->where('mobile', $request->name)
                ->orWhere('mobile_2', $request->name)
                ->orWhere('phone', $request->name)
                ->orWhere('whatsapp', $request->name)
                ->get();
        } elseif ($request->search_type == 2) {
            $rowData = CrmCustomers::query()
                ->where('name', 'like', '%' . $request->name . '%')
                ->get();
        } elseif ($request->search_type == 3) {
            $searchString = $request->name;
            $rowData = CrmCustomers::query()->with('address')->whereHas('address', function ($query) use ($searchString) {
                $query->where('address', 'like', '%' . $searchString . '%');
            })->get();
        }
        return $rowData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function addTicket($id) {
        return redirect()->route('admin.CrmLeads.addTicket', $id);
    }

*/
}
