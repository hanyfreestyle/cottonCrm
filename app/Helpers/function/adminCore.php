<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('SeedDbFile')) {
    function SeedDbFile($model, $file, $hasFolder = true) {
        if ($hasFolder) {
            $folder = config('adminConfig.app_folder');
            if (File::isFile(public_path('db/' . $folder . '/' . $file))) {
                $model::unguard();
                $tablePath = public_path('db/' . $folder . '/' . $file);
                DB::unprepared(file_get_contents($tablePath));
            }
        } else {
            if (File::isFile(public_path('db/' . $file))) {
                $model::unguard();
                $tablePath = public_path('db/' . $file);
                DB::unprepared(file_get_contents($tablePath));
            }
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getDefPermission')) {
    function getDefPermission($cat_id, $sendArr = array()) {
        $report = issetArr($sendArr, 'report', false);
        $filter = issetArr($sendArr, 'filter', false);
        $restore = issetArr($sendArr, 'restore', false);

        $newPer = [
            ['cat_id' => $cat_id, 'name' => $cat_id . '_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => $cat_id, 'name' => $cat_id . '_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => $cat_id, 'name' => $cat_id . '_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => $cat_id, 'name' => $cat_id . '_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
        ];

        if ($report) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_report', 'name_ar' => 'التقارير', 'name_en' => 'Report']];
            $newPer = array_merge($newPer, $add_new);
        }

        if ($filter) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_filter', 'name_ar' => 'تصفية النتائج', 'name_en' => 'Filter']];
            $newPer = array_merge($newPer, $add_new);
        }

        if ($restore) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore']];
            $newPer = array_merge($newPer, $add_new);
        }

        return $newPer;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('cashDay')) {
    function cashDay($days = 2) {
        $lifeTime = $days * (86400);
        return $lifeTime;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('Update_createDirectory')) {
    function Update_createDirectory($uploadDir) {
        $fullPath = $uploadDir;
        if (!File::isDirectory($fullPath)) {
            File::makeDirectory($fullPath, 0777, true, true);
        }
        return $uploadDir;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('loadConfigFromJson')) {
    function loadConfigFromJson($catId) {
        $arr = array();
        $folder = config('adminConfig.app_folder');
        if ($folder) {
            $filePath = base_path('config_' . $folder . '/app.json');
            if (File::isFile($filePath)) {
                $getArr = json_decode(file_get_contents($filePath), true);
                $arr = IsArr($getArr, $catId, $arr);
            }
        }
        return $arr;
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
if (!function_exists('getRoleName')) {
    function getRoleName() {
        if (thisCurrentLocale() == 'ar') {
            $sendName = "name_ar";
        } else {
            $sendName = "name_en";
        }
        return $sendName;
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
