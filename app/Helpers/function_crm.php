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
    function PrintDate($date,$format="Y-m-d") {
        $dateValue = Carbon::parse($date)->format($format);
        return $dateValue;
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
        }else{
            $col = "col-lg-".$col;
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
        }else{
            $col = "col-".$col;
        }
        return $col;
    }
}
