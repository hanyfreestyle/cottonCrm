<?php

namespace App\AppPlugin\Crm\ImportData;


use App\AppPlugin\Crm\Periodicals\Models\Periodicals;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Propaganistas\LaravelPhone\PhoneNumber;


class ImportDataController extends AdminMainController {

    function __construct() {
        parent::__construct();

    }


    public function CheckNum() {

        $removeLetter = ImportDataModel::where('check_num', null)->take(3000)->get();

        foreach ($removeLetter as $phone) {
            $get = ['*', '#', '00968', '00971'];
            $replace = ['', '', '+968', '+971'];
            $phone->get_phone = str_replace($get, $replace, $phone->get_phone);
            $phone->check_num = 1;
            $phone->save();
        }

        echobr(ImportDataModel::where('check_num', null)->count());
        echobr(ImportDataModel::where('check_num', 1)->count());
    }

    public function CheckNum1() {
        $deleteNoNumber = ImportDataModel::whereRaw('LENGTH(get_phone) <= 7')->get();
        foreach ($deleteNoNumber as $number) {
            echobr($number->id . " " . $number->get_phone);
            $number->delete();
        }
    }

    public function CheckNum2() {

        $removeLetter = ImportDataModel::where('check_num', 1)->take(3000)->get();
        foreach ($removeLetter as $phone) {
            $phone->get_phone = self::faTOen($phone->get_phone);
            $phone->check_num = 2;
            $phone->save();
        }

        echobr(ImportDataModel::where('check_num', 1)->count());
        echobr(ImportDataModel::where('check_num', 2)->count());

    }


    function faTOen($string) {
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }


    public function CheckNum3() {

        $removeLetter = ImportDataModel::where('num_count', null)->take(500)->get();
        foreach ($removeLetter as $phone) {
            $phone->num_count = ImportDataModel::where('get_phone', $phone->get_phone)->count();
            $phone->save();
        }

        echobr(ImportDataModel::where('num_count', null)->count());
        echobr(ImportDataModel::where('num_count', "!=", null)->count());

    }


    public function CheckNum4() {

        $removeLetter = ImportDataModel::where('num_count', ">", 1)->take(250)->get();
        foreach ($removeLetter as $phone) {
            $same_data = DB::table('config_data_import')->where('get_phone', $phone->get_phone);

            if ($same_data->count() > 1) {
                $same_data = DB::table('config_data_import')
                    ->where('get_phone', $phone->get_phone)
                    ->where('id', '!=', $phone->id)->delete();
            }

            $phone->num_count = ImportDataModel::where('get_phone', $phone->get_phone)->count();
            $phone->save();
        }


        echobr(ImportDataModel::where('num_count', 1)->count());
        echobr(ImportDataModel::where('num_count', ">", 1)->count());

    }


    public function CheckNum4_xx() {

        $removeLetter = ImportDataModel::where('num_count', ">", 1)->take(100)->get();
        foreach ($removeLetter as $phone) {
            $same_data = DB::table('config_data_import')->where('get_phone', $phone->get_phone);

            if ($same_data->count() > 1) {
                $same_data_before = clone $same_data;
                $top = $same_data->first();
                $same_data_before->where('id', '!=', $top->id)->delete();
            }

            $phone->num_count = ImportDataModel::where('get_phone', $phone->get_phone)->count();
            $phone->save();
        }


        echobr(ImportDataModel::where('num_count', 1)->count());
        echobr(ImportDataModel::where('num_count', ">", 1)->count());

    }


    public function checkCountry() {
        $removeLetter = ImportDataModel::where('check_country', null)->take(100)->get();
        foreach ($removeLetter as $phone) {
            if (strlen($phone->get_phone) == 12 and mb_substr($phone->get_phone, 0, 4) == '+968') {
                $phoneNumber = new PhoneNumber($phone->get_phone, 'OM');
                if ($phoneNumber->isOfCountry('OM')) {
                    $phone->phone = $phoneNumber->formatForMobileDialingInCountry('OM');
                    $phone->full_number = $phone->get_phone;
                    $phone->country_code = "+986";
                    $phone->country = "OM";
                    $phone->check_country = 1;
                } else {
                    $phone->check_country = 0;
                }
                $phone->save();
            } else {
                $phone->check_country = 0;
                $phone->save();
            }
        }

        echobr(ImportDataModel::where('check_country', null)->count());
        echobr(ImportDataModel::where('check_country', 0)->count());
        echobr(ImportDataModel::where('check_country', 1)->count());

    }


    public function checkCountryOM() {
        $removeLetter = ImportDataModel::where('num_count', null)->take(500)->get();

        foreach ($removeLetter as $phone) {
            $phone->num_count = ImportDataModel::where('full_number', $phone->full_number)->count();
            $phone->save();
        }

        echobr(ImportDataModel::where('num_count', null)->count());
        echobr(ImportDataModel::where('num_count', '>', 1)->count());
        echobr(ImportDataModel::where('num_count', 1)->count());

    }


    public function checkCountryOM_xx() {


//        $removeLetter = ImportDataModel::where('check_country', 0)->take(100)->get();
//        foreach ($removeLetter as $phone) {
//            if ( mb_substr($phone->get_phone, 0, 4) == '+905' ) {
//                $phone->delete();
//            }
//        }


        $removeLetter = ImportDataModel::where('check_country', 0)->take(100)->get();
        $removeLetter = ImportDataModel::where('check_country', 0)->where('id', 802)->take(100)->get();

        foreach ($removeLetter as $phone) {

            if (strlen($phone->get_phone) == 12 and mb_substr($phone->get_phone, 0, 4) == '+965') {

                $phoneNumber = new PhoneNumber($phone->get_phone, 'KW');
                if ($phoneNumber->isOfCountry('KW')) {
//                    dd(strlen($phone->get_phone));
//                    dd(strlen($phone->get_phone));
                    $phone->phone = $phoneNumber->formatForMobileDialingInCountry('SA');
                    $phone->full_number = $phone->get_phone;
                    $phone->country_code = "+965";
                    $phone->country = "KW";
                    $phone->check_country = 1;
                } else {
                    $phone->check_country = 0;
                }
                $phone->save();
            } else {
                $phone->check_country = 0;
                $phone->save();
            }
        }

        echobr(ImportDataModel::where('check_country', null)->count());
        echobr(ImportDataModel::where('check_country', 0)->count());
        echobr(ImportDataModel::where('check_country', 1)->count());

    }


    public function checkCountryU() {

//        $idArr = [
//            '15869', '14873', '11459', '9655', '10603', '11114', '9090', '19566', '148', '148', '148', '148', '148', '148', '148', '148',
//            '15869', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148',
//            '15869', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148', '148',
//        ];
//        $removeLetter = ImportDataModel::wherein('id', $idArr)->get();
//        foreach ($removeLetter as $ppp) {
//            $ppp->delete();
//        }
//        dd($removeLetter);

        $removeLetter = ImportDataModel::where('check_country', 0)->where('id', 9202)->take(100)->get();
        foreach ($removeLetter as $phone) {
            if ($phone->get_phone) {

            }

        }


        /*
        $removeLetter = ImportDataModel::where('check_country', 0)->take(100)->get();
        foreach ($removeLetter as $phone) {

            if (strlen($phone->get_phone) == 13 and mb_substr($phone->get_phone, 0, 4) == '+971') {
                $phoneNumber = new PhoneNumber($phone->get_phone, 'AE');


                if ($phoneNumber->isOfCountry('AE')) {

                    $phone->phone = $phoneNumber->formatForMobileDialingInCountry('AE');
                    $phone->full_number = $phone->get_phone;
                    $phone->country_code = "+971";
                    $phone->country = "AE";
                    $phone->check_country = 1;
                } else {
                    $phone->check_country = 0;
                }
                 $phone->save();
            } else {
                $phone->check_country = 0;
                $phone->save();
            }
        }

        echobr(ImportDataModel::where('check_country', null)->count());
        echobr(ImportDataModel::where('check_country', 0)->count());
        echobr(ImportDataModel::where('check_country', 1)->count());
*/
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function CheckNames() {

        $CheckNames = ImportDataModel::where('check_name', null)->get();
        foreach ($CheckNames as $updateData) {
            $getName = preg_replace('/\s+/', '', $updateData->get_name);
            if ($getName != null and $getName != $updateData->get_phone) {
                $updateData->name = $updateData->get_name;
            }
            if (!trim($updateData->email)) {
                $updateData->email = null;
            }

            if (!trim($updateData->organization)) {
                $updateData->organization = null;
            }
            $updateData->get_name = null;
            $updateData->check_name = 1;
            $updateData->save();

        }
    }


    function remove_emoji($string) {
        // Match Enclosed Alphanumeric Supplement
        $regex_alphanumeric = '/[\x{1F100}-\x{1F1FF}]/u';
        $clear_string = preg_replace($regex_alphanumeric, '', $string);

        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);

        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $clear_string);

        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);

        // Match Supplemental Symbols and Pictographs
        $regex_supplemental = '/[\x{1F900}-\x{1F9FF}]/u';
        $clear_string = preg_replace($regex_supplemental, '', $clear_string);

        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);

        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);

        return $clear_string;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function uploadExcel() {
        ini_set('memory_limit', '3000M');
        ini_set('max_execution_time', '0');

        dd('stop');
        ImportDataModel::truncate();

        $array = Excel::toArray(new ImportDataToExcel, storage_path('Book1.xlsx'));

        foreach ($array[0] as $data) {
            $saveData = new Periodicals();
            $saveData->name = $data[4];
            $saveData->save();

        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

    public function uploadExcel_xxx() {
        ini_set('memory_limit', '3000M');
        ini_set('max_execution_time', '0');

        dd('stop');
//        ImportDataModel::truncate();

//        $array = Excel::toArray(new ImportDataToExcel, storage_path('Google_Backup_6_29_2024_016.xlsx'));
        $array = Excel::toArray(new ImportDataToExcel, storage_path('file_3.xlsx'));

        foreach ($array[0] as $data) {
            $getPhones = explode('_x000D_', $data['phones']);
            if (count($getPhones) == 1) {
                $phone = $data['phones'];
                self::saveData($data, $phone);
            } else {
                $loop = 0;
                foreach ($getPhones as $phone) {
                    if ($loop == 0) {
                        self::saveData($data, $phone);
                    } else {
                        $lastId = ImportDataModel::where('sub_id', null)->orderBy('id', 'desc')->latest()->first();
                        self::saveData($data, $phone, $lastId->id);
                    }
                    $loop = $loop + 1;
                }
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function saveData($data, $phone, $sub_id = null) {
        $Br = "\n";


        $cleanPhone = preg_replace('/\s+/', '', $phone);
        $emails = preg_replace('/\s+/', '', $data['emails']);
        $f_name = preg_replace('/\s+/', '', $data['f_name']);
        $l_name = preg_replace('/\s+/', '', $data['l_name']);
        $m_name = preg_replace('/\s+/', '', $data['m_name']);
        $organization = preg_replace('/\s+/', '', $data['organization']);


        $allData = "";

        if ($emails) {
            $allData .= $emails . $Br;
        }
        if ($f_name) {
            $allData .= $f_name . $Br;
        }

        if ($m_name) {
            $allData .= $m_name . $Br;
        }

        if ($l_name) {
            $allData .= $l_name . $Br;
        }

        if ($organization) {
            $allData .= $organization . $Br;
        }

        if ($phone) {
            $allData .= $phone . $Br;
        }


        $getName = $f_name . " " . $m_name . " " . $l_name;

        $saveData = new ImportDataModel();
        $saveData->email = $emails;
        $saveData->organization = $organization;
        $saveData->email = $emails;
        $saveData->get_data = $allData;
        $saveData->get_name = self::remove_emoji($getName);


        if (trim($cleanPhone)) {
            $saveData->get_phone = $cleanPhone;
        } else {
            $saveData->get_phone = preg_replace('/\s+/', '', $getName);
        }

        if ($sub_id) {
            $saveData->sub_id = $sub_id;
        }
        $saveData->save();
        $LastId = $saveData->id;
        return $LastId;
    }
}


