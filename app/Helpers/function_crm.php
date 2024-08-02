<?php
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('LoadConfigName')) {
    function LoadConfigName($row,$val) {
        if (is_array($row)) {
            $row = collect($row);
        }
        return $row->where('id', $val)->first()->name ?? '';
    }
}
