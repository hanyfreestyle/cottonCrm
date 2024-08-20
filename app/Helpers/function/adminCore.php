<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $slug = issetArr($sendArr, 'slug', false);
        $teamLeader = issetArr($sendArr, 'teamLeader', false);

        $newPer = [
            ['cat_id' => $cat_id, 'name' => $cat_id . '_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => $cat_id, 'name' => $cat_id . '_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => $cat_id, 'name' => $cat_id . '_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => $cat_id, 'name' => $cat_id . '_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
        ];


        if ($restore) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore']];
            $newPer = array_merge($newPer, $add_new);
        }

        if ($slug) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug']];
            $newPer = array_merge($newPer, $add_new);
        }

        if ($report) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_report', 'name_ar' => 'التقارير', 'name_en' => 'Report']];
            $newPer = array_merge($newPer, $add_new);
        }

        if ($filter) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_filter', 'name_ar' => 'تصفية النتائج', 'name_en' => 'Filter']];
            $newPer = array_merge($newPer, $add_new);
        }

        if ($teamLeader) {
            $add_new = [['cat_id' => $cat_id, 'name' => $cat_id . '_teamleader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader']];
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
if (!function_exists('printCategoryName')) {
    function printCategoryName($key, $row, $url) {
        if ($row->children_count > 0) {
            if (isset($row->translate($key)->name)) {
                return '<a href="' . route($url, $row->id) . '">' . $row->translate($key)->name . ' (' . $row->children_count . ')</a>';
            } else {
                return null;
            }
        } else {
            return $row->translate($key)->name ?? '';
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('DefCategoryTextName')) {
    function DefCategoryTextName($key) {
        if ($key) {
            $send = $key;
        } else {
            $send = __('admin/def.category_name');
        }
        return $send;
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
if (!function_exists('getDefModelConfig')) {
    function getDefModelConfig() {
        $defPostConfig = [
            'TableCategory' => true,
            'TableTags' => true,
            'TableTagsOnFly' => false,
            'TableReview' => false,
            'TableMorePhotos' => true,
            'MorePhotosEdit' => true,

            'categoryTree' => false,
            'categoryDeep' => 2,
            'categoryPhotoAdd' => true,
            'categoryIcon' => false,
            'categoryDelete' => false,
            'categorySort' => false,
            'categoryEditor' => true,
            'categoryDes' => true,
            'categorySeo' => true,
            'categorySlug' => true,
            'categoryAddOnlyLang' => false,

            'postPublishedDate' => true,
            'postPhotoAdd' => true,
            'postEditor' => true,
            'postDes' => true,
            'postSeo' => true,
            'postSlug' => true,
            'postYoutube' => true,
            'postAddOnlyLang' => false,

            'postWebSlug' => null,
            "categoryWebSlug" => null,
        ];

        return $defPostConfig;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getDefSettings')) {
    function getDefSettings($conig, $type = 'category') {
        if ($type == 'category') {
            $settings = [
                'addPhoto' => IsConfig($conig, 'categoryPhotoAdd'),
                'addIcon' => IsConfig($conig, 'categoryIcon'),
            ];
        } elseif ($type == 'post') {
            $settings = [
                'addPhoto' => IsConfig($conig, 'postPhotoAdd'),
                'addMorePhoto' => IsConfig($conig, 'TableMorePhotos'),
                'dataTableUserName' => true,
                'dataTableDate' => true,
            ];
        }
        return $settings;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('loadConfigFromJson')) {
    function loadConfigFromJson($fileName,$defConfig) {
        $folder = config('adminConfig.app_folder');
        $destinationFolder = base_path('config_' . $folder);
        $filePath = base_path('config_' . $folder . '/' . $fileName . '.json');

        if (!File::isFile($filePath)) {
            if (!File::isDirectory($destinationFolder)) {
                File::makeDirectory($destinationFolder, 0777, true, true);
            }
            $fh = fopen($filePath, 'w') or die("can't open file");
            $defConfigjson = json_encode($defConfig);
            fwrite($fh, $defConfigjson);
            fclose($fh);
        }
        $configJson = json_decode(file_get_contents($filePath), true);
        return $configJson;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getConfigFromJson')) {
    function getConfigFromJson($fileName) {
        $folder = config('adminConfig.app_folder');
        $defConfig = getDefModelConfig();
        $destinationFolder = base_path('config_' . $folder);
        $filePath = base_path('config_' . $folder . '/' . $fileName . '.json');

        if (!File::isFile($filePath)) {
            if (!File::isDirectory($destinationFolder)) {
                File::makeDirectory($destinationFolder, 0777, true, true);
            }
            $fh = fopen($filePath, 'w') or die("can't open file");
            $defConfigjson = json_encode($defConfig);
            fwrite($fh, $defConfigjson);
            fclose($fh);
        }
        $configJson = json_decode(file_get_contents($filePath), true);
        return $configJson;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('dataTableDefLang')) {
    function dataTableDefLang() {
        if (count(config('app.web_lang')) > 1) {
            $lang = LaravelLocalization::getCurrentLocale();
        } else {
            $lang = config('app.def_dataTableLang');
        }
        return $lang;
    }
}
if (!function_exists('returnTableRes')) {
    function returnTableRes($agent) {
        if ($agent->isDesktop()) {
            $res = 'not-desktop';
        } else {
            $res = 'desktop';
        }
        return $res;
    }
}
if (!function_exists('returnTableId')) {
    function returnTableId($agent, $row) {
        if ($agent->isDesktop()) {
            return $row->id;
        } else {
            return null;
        }
    }
}
if (!function_exists('getDataTableCategoryName')) {
    function getDataTableCategoryName($row, $PrefixRoute) {
        $names = '';
        foreach (explode(',', $row->category_names) as $name) {
            $getId = explode(':', $name);
            $printName = $getId['1'] ?? null;
            $printId = $getId['0'] ?? 0;
            if (intval($printId) > 0) {
                $names .= '<a href="' . route($PrefixRoute . '.FilterCategory', $printId) . '"><span class="cat_table_name">' . $printName . '</span></a> ';
            } else {
                $names .= '<span class="cat_table_name">' . $printName . '</span> ';
            }
        };
        return $names;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
