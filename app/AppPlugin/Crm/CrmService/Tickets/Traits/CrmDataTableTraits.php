<?php


namespace App\AppPlugin\Crm\CrmService\Tickets\Traits;


use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

trait CrmDataTableTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function OpenTicketQuery($RouteVal, $PrefixRole) {
        $data = self::FilterUserPer_OpenTicket($PrefixRole);
        if ($RouteVal == "New") {
            $data->where('follow_state', 1);
        } elseif ($RouteVal == 'Today') {
            $data->where('follow_date', '=', Carbon::today());
        } elseif ($RouteVal == 'Back') {
            $data->where('follow_date', '<', Carbon::today());
        } elseif ($RouteVal == 'Next') {
            $data->where('follow_date', '>', Carbon::today());
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function FilterUserPer_OpenTicket($PrefixRole) {
        if (Auth::user()->hasPermissionTo($PrefixRole . '_admin') ?? false) {
            $data = self::DataTableIndex('open');
        } else {
            if (Auth::user()->hasPermissionTo($PrefixRole . '_team_leader') ?? false) {
                $thisUserId = [Auth::user()->id];
                if (is_array(Auth::user()->crm_team)) {
                    $thisUserId = array_merge($thisUserId, Auth::user()->crm_team);
                }
                $data = self::DataTableIndex('open')->WhereIn('user_id', $thisUserId);
            } else {
                $data = self::DataTableIndex('open')->where('user_id', Auth::user()->id);
            }
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function OpenTicketFollowUpQuery($RouteVal, $PrefixRole) {
        $data = self::ViewOpenTicketUserPer($PrefixRole);
        if ($RouteVal == "New") {
            $data->where('follow_state', 1);
        } elseif ($RouteVal == 'Today') {
            $data->where('follow_date', '=', Carbon::today());
        } elseif ($RouteVal == 'Back') {
            $data->where('follow_date', '<', Carbon::today());
        } elseif ($RouteVal == 'Next') {
            $data->where('follow_date', '>', Carbon::today());
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function ViewOpenTicketUserPer($PrefixRole) {
        if (Auth::user()->hasPermissionTo($PrefixRole . '_admin')) {
            $data = CrmTickets::defOpen()->with('paymentCash');
        } else {
            if (Auth::user()->hasPermissionTo($PrefixRole . '_team_leader')) {
                $thisUserId = [Auth::user()->id];
                if (is_array(Auth::user()->crm_team)) {
                    $thisUserId = array_merge($thisUserId, Auth::user()->crm_team);
                }
                $data = CrmTickets::defOpen()->with('paymentCash')->WhereIn('user_id', $thisUserId);
            } else {
                $data = CrmTickets::defOpen()->with('paymentCash')->where('user_id', Auth::user()->id);
            }
        }
        return $data;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function ClosedTicketQuery($RouteVal) {
        $data = self::DataTableIndex('close');
        if ($RouteVal == "Finished") {
            $data->where('follow_state', 2);
        } elseif ($RouteVal == 'Cancellation') {
            $data->where('follow_state', 5);
        } elseif ($RouteVal == 'Reject') {
            $data->where('follow_state', 6);
        }
        return $data;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function DataTableIndex($type) {

        $table = "crm_ticket";
        $table_customers = "crm_customers";
        $table_customers_address = "crm_customers_address";
        $table_user = 'users';
        $table_data = 'config_data_translations';
        $table_area_translations = 'data_area_translations';

        $data = DB::table($table);

        if ($type == 'open') {
            $data->where('state', 1)->where('user_id', '!=', null);
        }

        if ($type == 'close') {
            $data->where('state', 2);
        }


        $data->leftJoin("$table_customers", function ($join) use ($table_customers, $table) {
            $join->on($table . '.customer_id', '=', $table_customers . '.id');
        })
            ->leftJoin("$table_user", function ($join) use ($table_user, $table) {
                $join->on($table . '.user_id', '=', $table_user . '.id');
            })
            ->leftJoin("$table_customers_address", function ($join) use ($table_customers_address, $table) {
                $join->on($table . '.customer_id', '=', $table_customers_address . '.customer_id');
                $join->where($table_customers_address . '.is_default', '=', 1);
            })
            ->leftJoin("$table_data", function ($join) use ($table_data, $table) {
                $join->on($table . '.device_id', '=', $table_data . '.data_id');
                $join->where($table_data . '.locale', '=', 'ar');
            })
            ->leftJoin("$table_area_translations", function ($join) use ($table_area_translations, $table_customers_address) {
                $join->on($table_customers_address . '.area_id', '=', $table_area_translations . '.area_id');
                $join->where($table_area_translations . '.locale', '=', 'ar');
            })
            ->select("$table.*",
                "$table_customers.id  as customers_id",
                "$table_customers.name  as customers_name",
                "$table_customers.mobile  as customers_mobile",
                "$table_user.name  as user_name",
                "$table_data.name  as device_name",
                "$table_customers_address.country_id  as country_id",
                "$table_customers_address.city_id  as city_id",
                "$table_customers_address.area_id  as area_id",
                "$table_area_translations.name  as area_name",
            );

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function TicketFilter($query, $session, $order = null) {

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if (isset($session['follow_from']) and $session['follow_from'] != null) {
            $query->whereDate('follow_date', '>=', Carbon::createFromFormat('Y-m-d', $session['follow_from']));
        }

        if (isset($session['follow_to']) and $session['follow_to'] != null) {
            $query->whereDate('follow_date', '<=', Carbon::createFromFormat('Y-m-d', $session['follow_to']));
        }
        if (isset($session['user_id']) and $session['user_id'] != null) {
            $query->where('user_id', $session['user_id']);
        }
        if (isset($session['follow_state']) and $session['follow_state'] != null) {
            $query->where('follow_state', $session['follow_state']);
        }

        if (isset($session['sours_id']) and $session['sours_id'] != null) {
            $query->where('sours_id', $session['sours_id']);
        }
        if (isset($session['ads_id']) and $session['ads_id'] != null) {
            $query->where('ads_id', $session['ads_id']);
        }
        if (isset($session['device_id']) and $session['device_id'] != null) {
            $query->where('device_id', $session['device_id']);
        }
        if (isset($session['brand_id']) and $session['brand_id'] != null) {
            $query->where('brand_id', $session['brand_id']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $query->where('crm_customers_address.country_id', $session['city_id']);
        }

        if (isset($session['city_id']) and $session['city_id'] != null) {
            $query->where('crm_customers_address.city_id', $session['city_id']);
        }

        if (isset($session['area_id']) and $session['area_id'] != null) {
            $query->where('crm_customers_address.area_id', $session['area_id']);
        }

        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TicketDataTableColumns($data, $arr = array()) {
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
            ->editColumn('follow_date', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->follow_date)) . ' (' . getDateDifference($row->created_at, $row->follow_date) . ')',
                    'timestamp' => strtotime($row->follow_date)
                ];
            })
            ->editColumn('close_date', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->close_date)) . ' (' . getDateDifference($row->created_at, $row->close_date) . ')',
                    'timestamp' => strtotime($row->close_date)
                ];
            })
            ->editColumn('customers_name', function ($row) {
                return $row->customers_name;
            })
            ->editColumn('customers_mobile', function ($row) {
                return $row->customers_mobile;
            })
            ->editColumn('user_name', function ($row) {
                return $row->user_name;
            })
            ->editColumn('follow_state', function ($row) {
                return LoadConfigName($this->DefCat['CrmServiceTicketState'], $row->follow_state);
            })

            ->editColumn('changeUser', function ($row) {
                return view('datatable.but')->with(['btype' => 'changeUser', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->editColumn('viewInfo', function ($row) {
                return view('datatable.but')->with(['btype' => 'viewInfo', 'row' => $row])->render();
            })
            ->editColumn('cost', function ($row) {
                $amount = CrmTicketsCash::query()->wherein('amount_type', ['1','2','3'])->where('ticket_id',$row->id)->sum('amount');
                if ($amount){
                    return  number_format($amount);
                }else{
                    return null;
                }
            })

            ->rawColumns(['viewTicket', "Delete", 'changeUser', 'viewInfo', 'follow_date']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function config() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if ($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }

}
