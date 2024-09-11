<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\DB;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsDes;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Data\City\Models\City;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\If_;


class HooverDataController extends AdminMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getConfigData() {
        dd("hi");
        $LeadCategory = ConfigData::where('cat_id', 'LeadCategory')->count();
        if ($LeadCategory == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_lead_cat')->get();
            self::SaveData('LeadCategory', $oldData);
        }

        $LeadSours = ConfigData::where('cat_id', 'LeadSours')->count();
        if ($LeadSours == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_lead_sours')->get();
            self::SaveData('LeadSours', $oldData);
        }

        $BrandName = ConfigData::where('cat_id', 'BrandName')->count();
        if ($BrandName == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_brand')->get();
            self::SaveData('BrandName', $oldData);
        }

        $DeviceType = ConfigData::where('cat_id', 'DeviceType')->count();
        if ($DeviceType == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_device_type')->get();
            self::SaveData('DeviceType', $oldData);
        }

        $Areas = Area::count();
        if ($Areas == 0) {
            $oldData = DB::connection('mysql2')->table('config_data')->where('cat_id', 'f_area')->get();
            self::SaveDataArea($oldData);
        }

        /*
        عميل مميز
        عميل متردد
        عميل مزعج
        عميل خالص
        عميل الغاء
        عميل رفض
        */

    }

    static function SaveDataArea($oldData) {
        if (count($oldData) != 0) {
            foreach ($oldData as $data) {
                $saveData = new Area();
                $saveData->old_id = $data->id;
                $saveData->country_id = 66;

                if ($data->pro_id == 189) {
                    $cityId = 10;
                } elseif ($data->pro_id == 175) {
                    $cityId = 4;
                } elseif ($data->pro_id == 176) {
                    $cityId = 1;
                }
                $saveData->city_id = $cityId;
                $saveData->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = AreaTranslation::where('area_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->area_id = $saveData->id;
                    if ($key == 'ar') {
                        $PrintName = "name";
                    } else {
                        $PrintName = "name_en";
                    }

                    $saveTranslation->name = $data->$PrintName;
                    $saveTranslation->save();
                }
            }
        }
    }

    static function SaveData($cat_id, $oldData) {
        if (count($oldData) != 0) {
            foreach ($oldData as $data) {
                $saveData = new ConfigData();
                $saveData->old_id = $data->id;
                $saveData->cat_id = $cat_id;
                $saveData->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = ConfigDataTranslation::where('data_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->locale = $key;
                    $saveTranslation->data_id = $saveData->id;
                    if ($key == 'ar') {
                        $PrintName = "name";
                    } else {
                        $PrintName = "name_en";
                    }

                    $saveTranslation->name = $data->$PrintName;
                    $saveTranslation->save();
                }
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getCustomerData() {
        dd('getCustomerData');
        $saveData = 1;
        $oldData = DB::connection('mysql2')->table('customer')->get();
        foreach ($oldData as $data) {
            $saveCustomer = new  CrmCustomers();
            $saveCustomer->created_at = Carbon::createFromTimestamp($data->date_add);
            $saveCustomer->updated_at = Carbon::createFromTimestamp($data->date_add);
            $saveCustomer->old_id = $data->id;
            $saveCustomer->name = $data->name;
            $saveCustomer->mobile = $data->mobile;
            $saveCustomer->mobile_code = 'eg';

            if ($data->mobile_2 != '') {
                $saveCustomer->mobile_2 = $data->mobile_2;
                $saveCustomer->mobile_2_code = 'eg';
            }
            if ($data->phone != '') {
                $saveCustomer->phone = $data->phone;
                $saveCustomer->phone_code = 'eg';
            }

            if ($saveData) {
                $saveCustomer->save();
            }

            $saveCustomersAddress = new  CrmCustomersAddress();
            $saveCustomersAddress->uuid = Str::uuid()->toString();
            $saveCustomersAddress->is_default = 1;
            $saveCustomersAddress->customer_id = $saveCustomer->id;

            $saveCustomersAddress->country_id = '66';
            $saveCustomersAddress->city_id = null;
            $saveCustomersAddress->old_city_id = $data->city;
            $saveCustomersAddress->area_id = null;
            $saveCustomersAddress->old_area_id = $data->area;

            $saveCustomersAddress->address = $data->address;
            if ($data->floor != '') {
                $saveCustomersAddress->floor = $data->floor;
            }

            if ($data->unit_num != '') {
                $saveCustomersAddress->unit_num = $data->unit_num;
            }

            if ($saveData) {
                $saveCustomersAddress->save();
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function syncCity() {
        dd("syncCity");
        $allCity = City::query()->get();
        $allArea = Area::query()->get();
        $getoldDate = CrmCustomersAddress::query()
            ->where('city_id', null)
            ->where('area_id', null)->get();

        foreach ($getoldDate as $oldDate) {
            $oldDate->city_id = $allCity->where('old_id', $oldDate->old_city_id)->first()->id ?? null;
            $oldDate->area_id = $allArea->where('old_id', $oldDate->old_area_id)->first()->id ?? null;
            $oldDate->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateNames() {
//        dd('UpdateNames');

        $rep = [
            '\\\\', '\\', 'الحج', 'الحجة', '.سلوى', 'محمدسلطان', 'السيدخلف', 'عبدالرسول', 'عبدالمنعم', 'عبدالحميد', 'عبدالغني', 'محمدرؤوف', 'رناطارق',
            'محمدزكى', 'احمدمسعد', 'هويدامصطفى', 'ابوبكر', 'محمدحلمي', 'محمودالطماوي', 'ابوعمرو', 'محمدجمال', 'معتزغنيم', 'نادرحسن', 'مصطى', 'مروة.',
            'عبدالله', 'عبدالمجيد', 'عبدالهادي', 'عبدالوارث', 'عبدالخالق', 'عبدالرحمن', 'عبدالسلام', 'عبدالعزيز', 'عبدالعظيم', 'عبدالعليم', 'عبدالقادر', 'عبدالكريم', 'عبدالله',
            'السيدعبد', 'سلافة', 'عبدالباقي', 'عبدالحليم', 'عبدالرحيم', 'مداد', 'مهندس-', 'ابوالسيد', 'عبدالغفار', 'رضاالله', 'شِريف', 'ناد رحسن'
        ];
        $rep_r = [
            ' / ', ' / ', 'الحاج ', 'الحاجة', 'سلوى', 'محمد سلطان', 'السيد خلف', 'عبد الرسول', 'عبد المنعم', 'عبد الحميد', 'عبد الغني', 'محمد رؤوف', 'رنا طارق',
            'محمد زكى', 'احمد مسعد', 'هويدا مصطفى', 'ابو بكر', 'محمد حلمي', 'محمود الطماوي', 'ابو عمرو', 'محمد جمال', 'معتز غنيم', 'ناد رحسن', 'مصطفي', 'مروة ',
            'عبد الله', 'عبد المجيد', 'عبد الهادي ', 'عبد الوارث', 'عبد الخالق', 'عبد الرحمن', 'عبد السلام', 'عبد العزيز', 'عبد العظيم', 'عبد العليم', 'عبد القادر', 'عبد الكريم', 'عبد الله',
            'السيد عبد', 'سلامة', 'عبد الباقي', 'عبد الحليم', 'عبد الرحيم', 'مدام', 'مهندس ', 'ابو السيد', 'عبد الغفار', 'رضا الله', 'شريف', 'نادر حسن'
        ];

        $CustomersNames = CrmCustomers::query()->get();
        foreach ($CustomersNames as $name) {
            $name->name = str_replace($rep, $rep_r, $name->name);
            $name->timestamps = false;
            $name->save();
        }

        $CustomersNames = CrmCustomers::query()->where('gender_id', null)->get();
        foreach ($CustomersNames as $name) {
            $name->gender_id = guessGender($name->name);
            $name->timestamps = false;
            $name->save();
        }

        $idArr = ['3084'];
        $CustomersNames = CrmCustomers::query()->whereIn('id', $idArr)->get();
        foreach ($CustomersNames as $name) {
            $name->name = "وائل غانم";
            $name->timestamps = false;
            $name->save();
        }

        $idArr = ['1995', '2210', '1225', '3138', '1233', '1238', '1982'];
        $CustomersNames = CrmCustomers::query()->whereIn('id', $idArr)->get();
        foreach ($CustomersNames as $name) {
            $name->name = "الاسم غير محدد ";
            $name->timestamps = false;
            $name->save();
        }

        $rep = [
            'أ.', 'أ/', 'ا /', 'ا.', 'ا/', 'د /', 'د.', 'د-', 'م.', 'م/', 'م-', 'د/', 'م /', 'د,', 'د / '
        ];
        $rep_r = [
            '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
        ];

        $CustomersNames = CrmCustomers::query()->where('gender_id', null)->get();
        foreach ($CustomersNames as $name) {
            $name->name = str_replace($rep, $rep_r, $name->name);
            $name->timestamps = false;
            $name->save();
        }

        $CustomersNames = CrmCustomers::query()->where('gender_id', null)->get();
        foreach ($CustomersNames as $name) {
            $name->gender_id = guessGender($name->name);
            $name->timestamps = false;
            $name->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getTicket() {
        dd('getTicket');

        $oldData = DB::connection('mysql2')->table('sales_ticket')
            ->orderBy('id')
            ->get();

        foreach ($oldData as $data) {
            $saveTicket = new CrmTickets();

            $saveTicket->user_id = $data->user_id;
            $saveTicket->created_at = Carbon::createFromTimestamp($data->date_add);
            $saveTicket->updated_at = Carbon::createFromTimestamp($data->date_add);

            $saveTicket->old_id = $data->id;
            $saveTicket->old_customer_id = $data->cust_id;
            $saveTicket->old_sours_id = $data->lead_sours;
            $saveTicket->old_ads_id = $data->lead_cat;
            $saveTicket->old_device_id = $data->device_type;
            $saveTicket->old_brand_id = $data->brand;

            $saveTicket->open_type = $data->open_type;
            $saveTicket->state = $data->open_state;
            $saveTicket->follow_state = $data->state;

            $saveTicket->follow_date = Carbon::createFromTimestamp($data->follow_date) ?? null;
            if ($data->open_state != 1) {
                $saveTicket->close_date = Carbon::createFromTimestamp($data->close_date) ?? null;
            }

            $saveTicket->notes = $data->notes ?? null;
            $saveTicket->notes_err = $data->err_type ?? null;
            $saveTicket->done_price = $data->done_price ?? null;
            $saveTicket->done_price_prepaid = $data->done_price_prepaid ?? null;
            if ($data->id == 852) {
                $saveTicket->done_price_prepaid = 0;
            }

            if ($data->done_price_prepaid == 1) {
                $saveTicket->done_price_prepaid = 1000;
            }

            $saveTicket->done_notes = $data->done_notes ?? null;
            $saveTicket->reject_notes = $data->reject_notes ?? null;
            $saveTicket->cancellation_notes = $data->cancellation_notes ?? null;
            $saveTicket->save();

        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function syncTicketData() {
//        dd("syncTicketData");
        $allCustomers = CrmCustomers::query()->select('id', 'old_id')->get();
        $configData = ConfigData::query()->select('id', 'old_id')->get();


        $tickets = CrmTickets::query()
            ->whereNull('customer_id')
            ->take(250)
            ->get();


        foreach ($tickets as $updateTicket) {
            $updateTicket->customer_id = $allCustomers->where('old_id', $updateTicket->old_customer_id)->first()->id;
            $updateTicket->sours_id = $configData->where('old_id', $updateTicket->old_sours_id)->first()->id;
            $updateTicket->ads_id = $configData->where('old_id', $updateTicket->old_ads_id)->first()->id;
            $updateTicket->device_id = $configData->where('old_id', $updateTicket->old_device_id)->first()->id;
            $updateTicket->brand_id = $configData->where('old_id', $updateTicket->old_brand_id)->first()->id;
            $updateTicket->timestamps = false;
            $updateTicket->save();
//            dd($updateTicket);
        }
        echobr(CrmTickets::query()->whereNull('customer_id')->count());
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CheckPriceWithClosed() {

        $getTickets = CrmTickets::query()
            ->where('state', 2)
            ->where('done_price_prepaid', '>', 0)
            ->where('done_price', '<=', 0)
            ->get();


        foreach ($getTickets as $tickets) {
            if ($tickets->id == 2914) {
                $tickets->done_price = 2100;
                $tickets->timestamps = false;
                $tickets->save();
            }

            if ($tickets->id == 3418) {
                $tickets->done_price = 1000;
                $tickets->done_price_prepaid = 0;
                $tickets->timestamps = false;
                $tickets->save();
            }

            if ($tickets->id == 1396 or $tickets->id == 1208 or $tickets->id == 788) {
                $tickets->done_price = 0;
                $tickets->done_price_prepaid = 0;
                $tickets->follow_state = 6;
                $tickets->timestamps = false;
                $tickets->save();
            }

            if ($tickets->follow_state == 5 or $tickets->follow_state == 6) {
                $tickets->done_price_prepaid = 0;
                $tickets->done_price = 0;
                $tickets->timestamps = false;
                $tickets->save();
            }


            echobr($tickets->id . " " . $tickets->done_price_prepaid . " " . $tickets->done_price . " " . $tickets->state . " " . $tickets->follow_state);
            echobr($tickets->old_id);
            echobr('------------------------');
        }


        dd($getTickets->count());
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateCancellation() {
//        dd('UpdateCancellation');
        $tickets = CrmTickets::query()
            ->whereNotNull('old_customer_id')
            ->where('state', 2)
            ->where('follow_state', 5)
            ->take(500)
            ->get();

        foreach ($tickets as $updateTicket) {
            $addNotes = new CrmTicketsDes();

            $addNotes->created_at = $updateTicket->close_date;
            $addNotes->ticket_id = $updateTicket->id;
            $addNotes->user_id = $updateTicket->user_id;
            $addNotes->follow_state = $updateTicket->follow_state;
            $addNotes->des = $updateTicket->cancellation_notes;
            $addNotes->save();

            $updateTicket->old_customer_id = null;
            $updateTicket->follow_date = null;
            $updateTicket->old_sours_id = null;
            $updateTicket->old_ads_id = null;
            $updateTicket->old_device_id = null;
            $updateTicket->old_brand_id = null;
            $updateTicket->cancellation_notes = null;
            $tickets->timestamps = false;
            $updateTicket->save();
        }

        echobr(CrmTickets::query()
            ->whereNotNull('old_customer_id')
            ->where('state', 2)
            ->where('follow_state', 5)->count());

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateReject() {
//        dd("UpdateReject");
        $tickets = CrmTickets::query()
            ->whereNotNull('old_customer_id')
            ->where('state', 2)
            ->where('follow_state', 6)
            ->take(250)
            ->get();

        foreach ($tickets as $updateTicket) {
            $addNotes = new CrmTicketsDes();

            $addNotes->created_at = $updateTicket->close_date;
            $addNotes->ticket_id = $updateTicket->id;
            $addNotes->user_id = $updateTicket->user_id;
            $addNotes->follow_state = $updateTicket->follow_state;
            $addNotes->des = $updateTicket->reject_notes;
            $addNotes->save();

            $updateTicket->old_customer_id = null;
            $updateTicket->follow_date = null;
            $updateTicket->old_sours_id = null;
            $updateTicket->old_ads_id = null;
            $updateTicket->old_device_id = null;
            $updateTicket->old_brand_id = null;
            $updateTicket->reject_notes = null;
            $tickets->timestamps = false;
            $updateTicket->save();
        }

        echobr(CrmTickets::query()
            ->whereNotNull('old_customer_id')
            ->where('state', 2)
            ->where('follow_state', 6)->count());

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateFinished() {
//        dd("UpdateFinished");
        $saveData = true;
        $saveConfirm = true;
        $tickets = CrmTickets::query()
            ->whereNotNull('old_customer_id')
            ->where('state', 2)
            ->where('follow_state', 2)
            ->take(500)
            ->get();

        foreach ($tickets as $updateTicket) {
            $addNotes = new CrmTicketsDes();
            $addNotes->created_at = $updateTicket->close_date;
            $addNotes->ticket_id = $updateTicket->id;
            $addNotes->user_id = $updateTicket->user_id;
            $addNotes->follow_state = $updateTicket->follow_state;
            $addNotes->des = $updateTicket->done_notes;
            if ($saveData) {
                $addNotes->save();
            }


            $addCash = new CrmTicketsCash();
            $addCash->ticket_id = $updateTicket->id;
            $addCash->customer_id = $updateTicket->customer_id;
            $addCash->follow_state = 2;
            $addCash->created_at = $updateTicket->close_date;
            $addCash->created_at_time = null;
            $addCash->user_id = $updateTicket->user_id;
            $addCash->pay_type = 1;
            $addCash->amount_type = 1;
            $addCash->amount = $updateTicket->done_price;

            if ($saveConfirm) {
                $addCash->confirm_date = $updateTicket->close_date;
                $addCash->confirm_date_time = null;
                $addCash->confirm_user_id = 1;
                $addCash->amount_paid = $updateTicket->done_price;
            }

            if ($saveData) {
                $addCash->save();
            }

            if (intval($updateTicket->done_price_prepaid) > 0) {
                $addCash = new CrmTicketsCash();
                $addCash->ticket_id = $updateTicket->id;
                $addCash->customer_id = $updateTicket->customer_id;
                $addCash->follow_state = 3;
                $addCash->created_at = $updateTicket->close_date;
                $addCash->created_at_time = null;
                $addCash->user_id = $updateTicket->user_id;
                $addCash->pay_type = 1;
                $addCash->amount_type = 2;
                $addCash->amount = $updateTicket->done_price_prepaid;
                if ($saveConfirm) {
                    $addCash->confirm_date = $updateTicket->close_date;
                    $addCash->confirm_date_time = null;
                    $addCash->confirm_user_id = 1;
                    $addCash->amount_paid = $updateTicket->done_price_prepaid;
                }

                if ($saveData) {
                    $addCash->save();
                }
            }


            $updateTicket->old_customer_id = null;
            $updateTicket->follow_date = null;
            $updateTicket->old_sours_id = null;
            $updateTicket->old_ads_id = null;
            $updateTicket->old_device_id = null;
            $updateTicket->old_brand_id = null;
            $updateTicket->done_notes = null;
            $tickets->timestamps = false;
            if ($saveData) {
                $updateTicket->save();
            }

        }

        echobr(CrmTickets::query()
            ->whereNotNull('old_customer_id')
            ->where('state', 2)
            ->where('follow_state', 2)->count());

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateTicketUUid() {
        $tickets = CrmTickets::query()
            ->whereNull('uuid')
            ->take(500)
            ->get();

        foreach ($tickets as $updateTicket) {
            $updateTicket->uuid = Str::uuid()->toString();
            $updateTicket->timestamps = false;
            $updateTicket->save();
        }
        echobr(CrmTickets::query()->whereNull('uuid')->count());
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateCustomerUUid() {
        $tickets = CrmCustomers::query()
            ->whereNull('uuid')
            ->take(500)
            ->get();

        foreach ($tickets as $updateTicket) {
            $updateTicket->uuid = Str::uuid()->toString();
            $updateTicket->timestamps = false;
            $updateTicket->save();
        }
        echobr(CrmCustomers::query()->whereNull('uuid')->count());
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateCustomerTypes() {
        $openT = CrmTickets::query()->where('state', 1)->pluck('customer_id');
//        dd($openT);
        $Customers = CrmCustomers::query()
            ->whereNotIn('id', $openT)
            ->whereNull('type_id')
            ->take(500)
            ->get();

        foreach ($Customers as $updateCustomer) {
            $countDone = CrmTickets::query()
                ->where('customer_id', $updateCustomer->id)
                ->where('state', 2)
                ->where('follow_state', '2')->count();
            if ($countDone >= 1) {
                $updateCustomer->type_id = 1;
            } else {
                $updateCustomer->type_id = 2;
            }

            $updateCustomer->timestamps = false;
            $updateCustomer->save();
        }

        echobr(CrmCustomers::query()->whereNull('type_id')->whereNotIn('id', $openT)->count());
    }


}





