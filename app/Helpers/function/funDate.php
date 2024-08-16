<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('CheckDateFormat')) {
    function CheckDateFormat($value) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $value)) {
            $dateValue = Carbon::parse($value)->format("Y-m-d");
        } else {
            $dateValue = $value;
        }
        return $dateValue;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('SaveDateFormat')) {
    function SaveDateFormat($request, $name) {
        if ($request->input($name) == null) {
            $dateValue = Carbon::parse(now())->format("Y-m-d");
        } else {
            $dateValue = Carbon::parse($request->input($name))->format("Y-m-d");
        }
        return $dateValue;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('PrintDate')) {
    function PrintDate($date, $format = "Y-m-d") {
        $dateValue = Carbon::parse($date)->format($format);
        return $dateValue;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getCurrentTime')) {
    function getCurrentTime() {
        if (config('app.timezone') == "Africa/Cairo") {
            $now = Carbon::now(config('app.timezone'));
            // الجمعة الأخيرة من شهر أبريل
            $summerStart = Carbon::createFromDate(null, 4, 1, 'Africa/Cairo')->lastOfMonth(Carbon::FRIDAY);
            // الجمعة الأخيرة من شهر أكتوبر
            $summerEnd = Carbon::createFromDate(null, 10, 1, 'Africa/Cairo')->lastOfMonth(Carbon::FRIDAY);

//            $summerEnd = Carbon::createFromDate($now->year, 8, 16, 'Africa/Cairo');

            if ($now->between($summerStart, $summerEnd)) {
                // تعديل التوقيت الصيفي
                $now->addHour();
            }
        } else {
            $now = Carbon::now(config('app.timezone'));
        }
        return $now;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
