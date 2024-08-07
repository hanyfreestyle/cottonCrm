<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
use Illuminate\Support\Carbon;

if (!function_exists('IsConfig')) {
    function IsConfig($Arr, $Name, $DefVall = false) {
        if (isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
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
if (!function_exists('TicketDateFrom')) {
    function TicketDateFrom($date) {
        $diff_h = Carbon::parse($date)->diff(Carbon::now());
        $diff = Carbon::parse($date)->diffForHumans(Carbon::now());
        if ($diff_h->d > 0) {
            return " ( " . $diff . " )";
        } else {
            return null;
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('TicketSendWhatsapp')) {
    function TicketSendWhatsapp($row) {
        $Brek = "%0a";
        $GetMass = __('admin/crm/ticket.but_whatsapp_mass') . $Brek;
        $GetMass .= $row->customer->name;
        $Mass = str_replace(" ", "+", $GetMass);
        if ($row->customer->mobile_code == 'eg') {
            $Whatsapp_Url = 'https://api.whatsapp.com/send/?phone=2' . $row->customer->mobile . '&text=' . $Mass;
        }
        return $Whatsapp_Url;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('LoadConfigName')) {
    function LoadConfigName($row, $val) {
        if (is_array($row)) {
            $row = collect($row);
        }
        return $row->where('id', $val)->first()->name ?? '';
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getCol')) {
    function getCol($col) {
        if ($col == null) {
            $col = "col-lg-3";
        } else {
            $col = "col-lg-" . $col;
        }
        return $col;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getColMobile')) {
    function getColMobile($col) {
        if ($col == null) {
            $col = "col-6";
        } else {
            $col = "col-" . $col;
        }
        return $col;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('returnTableRes')) {
    function returnTableRes($agent) {
        if($agent->isDesktop()){
            $res = 'not-desktop';
        }else{
            $res = 'desktop';
        }

        return $res ;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('returnTableId')) {
    function returnTableId($agent,$row) {
        if ($agent->isDesktop()) {
            return $row->id;
        } else {
            return null;
        }
    }
}
