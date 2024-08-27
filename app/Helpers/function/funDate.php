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
if (!function_exists('CheckDateFormatState')) {
    function CheckDateFormatState($date) {
//        $date = "2024-08-18"; // على سبيل المثال
        $year_min = 1900;
        $year_max = 2099;

        if (preg_match('/^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/', $date)) {
            list($year, $month, $day) = explode('-', $date);

            if ($year >= $year_min && $year <= $year_max && checkdate($month, $day, $year)) {
//                echo "التاريخ صحيح ويتبع التنسيق.";
                return true;
            } else {
                return null;
            }
        } else {
            return null;
        }
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
if (!function_exists('saveOnlyDate')) {
    function saveOnlyDate() {
        $dateValue = Carbon::parse(now())->format("Y-m-d");
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
if (!function_exists('getDateDifference')) {
    function getDateDifference($date, $ToDate) {
        // تعريف الوحدات الزمنية وطول كل وحدة بالثواني
        $periods = array("ثانية", "دقيقة", "ساعات", "يوم", "أسبوع", "شهر", "عام");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $date = strtotime($date);
        $ToDate = strtotime($ToDate);


        // تحديد الفرق بين التاريخين
        if ($date > $ToDate) {
            $difference = $date - $ToDate;
            //$tense = "منذ";
        } else {
            $difference = $ToDate - $date;
            //$tense = "من الآن";
        }

        // حساب الفرق لكل فترة زمنية
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        // التحقق من حالة اليوم نفسه
        if ($difference == 0) {
            return "today";
        } else {
            return "$difference $periods[$j]";
        }
    }

}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
