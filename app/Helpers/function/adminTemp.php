<?php

use App\AppCore\UploadFilter\Models\UploadFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('defAdminAssets')) {
    function defAdminAssets($path, $secure = null): string {
        return app('url')->asset('assets/admin/' . $path, $secure);
    }
}
if (!function_exists('defAdminClient')) {
    function defAdminClient($path, $secure = null): string {
        return app('url')->asset('assets/admin/client/' . $path, $secure);
    }
}
if (!function_exists('defAdminPluginsAssets')) {
    function defAdminPluginsAssets($path, $secure = null): string {
        return app('url')->asset('assets/admin-plugins/' . $path, $secure);
    }
}
if (!function_exists('PdfAssets')) {
    function PdfAssets($path, $secure = null): string {
        return app('url')->asset('assets/pdf/' . $path, $secure);
    }
}
if (!function_exists('flagAssets')) {
    function flagAssets($path, $secure = null): string {
        return app('url')->asset('assets/flag/' . $path, $secure);
    }
}
if (!function_exists('defImagesDir')) {
    function defImagesDir($path, $secure = null): string {
        return app('url')->asset($path, $secure);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('thisCurrentLocale')) {
    function thisCurrentLocale() {
        return LaravelLocalization::getCurrentLocale();
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('htmlArDir')) {
    function htmlArDir() {
        $sendStyle = ' dir="' . LaravelLocalization::getCurrentLocaleDirection() . '" ';
        return $sendStyle;
    }
}
if (!function_exists('mainBodyStyle')) {
    function mainBodyStyle() {
        $sendStyle = "sidebar-mini ";
        if (config('adminConfig.sidebar_collapse_hide') == true) {
            $sendStyle = ' ';
        }
        if (config('adminConfig.sidebar_collapse') == true) {
            $sendStyle .= ' sidebar-collapse ';
        }
        if (config('adminConfig.sidebar_fixed') == true) {
            $sendStyle .= ' layout-fixed ';
        }
        if (config('adminConfig.top_navbar_fixed') == true) {
            $sendStyle .= ' layout-navbar-fixed ';
        }
        if (config('adminConfig.footer_fixed') == true) {
            $sendStyle .= ' layout-footer-fixed ';
        }
        if (config('adminConfig.dark-mode') == true) {
            $sendStyle .= ' dark-mode ';
        }
        if (config('adminConfig.pace_progress') == true) {
            $sendStyle .= ' ' . config('adminConfig.pace_progress_style') . ' ';
        }

        return $sendStyle;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('sidebarCollapse')) {
    function sidebarCollapse() {
        $session = Session::get('sidebarCollapse');
        if ($session == null) {
            if (config('app.SideBarCollapse')) {
                $state = " sidebar-collapse sidebar-mini ";
            } else {
                $state = null;
            }
        } else {
            $state = $session;
        }
        return $state;
    }
}
if (!function_exists('sidebarCollapseIcon')) {
    function sidebarCollapseIcon() {
        $session = Session::get('sidebarCollapse');
        if ($session == null) {
            $icon = '<i class="fas fa-compress-arrows-alt"></i>';
        } else {
            $icon = '<i class="fas fa-compress"></i>';
        }
        return $icon;
    }
}
if (!function_exists('sideBarAccordion')) {
    function sideBarAccordion($state = true) {
        if ($state == true) {
            $style = null;
        } else {
            $style = ' data-accordion="false" ';
        }
        return $style;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('navBarStyle')) {
    function navBarStyle() {
        $sendStyle = " navbar-white ";
        if (config('adminConfig.top_navbar_dark') == true or config('adminConfig.dark-mode') == true) {
            $sendStyle = ' navbar-dark ';
        }
        return $sendStyle;
    }
}
if (!function_exists('sideBarNavUlStyle')) {
    function sideBarNavUlStyle() {
        $sendStyle = " ";
        if (config('adminConfig.sidebar_flat_style') == true) {
            $sendStyle = ' nav-flat ';
        }
        return $sendStyle;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('TablePhoto')) {
    function TablePhoto($row, $fildeName = 'photo_thum_1') {
        if ($row->$fildeName ?? false) {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defImagesDir($row->$fildeName) . '">';
        } else {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defAdminAssets('img/default-150x150.png') . '">';
        }
        return $sendImg;
    }
}
if (!function_exists('TablePhotoFlag')) {
    function TablePhotoFlag($row, $fildeName = 'photo_thum_1') {
        if ($row->$fildeName ?? false) {
            $sendImg = '<img  class="tableImg country_table_flag img-rounded" src="' . flagAssets($row->$fildeName) . '">';
        } else {
            $sendImg = '<img  class="tableImg img-rounded country_table_flag elevation-1" src="' . defAdminAssets('img/default-150x150.png') . '">';
        }
        return $sendImg;
    }
}
if (!function_exists('TablePhotoFlag_Code')) {
    function TablePhotoFlag_Code($row, $fildeName = 'photo_thum_1') {
        if ($row->$fildeName ?? false) {
            $sendImg = '<img  class="tableImg cust_country img-rounded" src="' . flagAssets("120/" . $row->$fildeName) . '.webp">';
        } else {
            $sendImg = '<img  class="tableImg img-rounded elevation-1" src="' . defAdminAssets('img/default-150x150.png') . '">';
        }
        return $sendImg;
    }
}
if (!function_exists('UserProfilePhoto')) {
    function UserProfilePhoto($fildeName = 'photo_thum_1') {
        if (Auth::user()->$fildeName ??false) {
            $sendImg = defImagesDir(Auth::user()->$fildeName);
        } else {
            $sendImg = defAdminAssets('img/user_avatar.jpg');
        }
        return $sendImg;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('AdminActiveMenu')) {
    function AdminActiveMenu($SubMenu) {
        $SubMenus = explode('|', $SubMenu);
        foreach ($SubMenus as $SubMenu) {
            if (Route::is('*.' . $SubMenu)) {
                return 'active';
            }
        }
    }
}
if (!function_exists('setActiveRoute')) {
    function setActiveRoute($main, $arrs = array()) {
        $defArr = ['index', 'create', 'edit', 'config', 'index_Main', 'SubCategory', 'CatSort', 'editEn', 'editAr', 'create_ar', 'create_en', 'filter'];
        $arrs = array_merge($defArr, $arrs);
        $line = "";
        foreach ($arrs as $arr) {
            $line .= $main . "." . $arr . "|";
        }
        return $line;
    }
}
if (!function_exists('puzzleMenu')) {
    function puzzleMenu($Route, $selRoute) {
        if ($selRoute == $Route) {
            return 'd';
        } else {
            return 'dark';
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('echobr')) {
    function echobr($text = "") {
        if ($text == "hr") {
            $text = '<hr/>';
        }
        echo $text . "<br/>";
    }
}
if (!function_exists('echoPrintR')) {
    function echoPrintR($arr) {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('Table_Style')) {
    function Table_Style($viewDataTable, $yajraTable = false) {
        if ($viewDataTable) {
            if ($yajraTable) {
                $tableHeader = ' id="" class="table table-bordered table-hover DataTableView" ';
            } else {
                $tableHeader = ' id="MainDataTable" class="table table-bordered table-hover" ';
            }
        } else {
            $tableHeader = ' class="table table-hover" ';
        }
        return $tableHeader;
    }
}
if (!function_exists('Table_Style_Normal')) {
    function Table_Style_Normal($addClass = null) {
        $tableHeader = ' class="table table-hover rwd_table ' . $addClass . ' " ';
        return $tableHeader;
    }
}
if (!function_exists('Table_Style_Yajra')) {
    function Table_Style_Yajra($addClass = null) {
        $tableHeader = ' id="YajraDatatable" class="table table-bordered table-hover DataTableView ' . $addClass . ' " ';
        return $tableHeader;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('is_active')) {
    function is_active($is_active) {
        if ($is_active == 1) {
            $icon = '<img width="25" src="' . defAdminAssets('img/active.webp') . '">';
        } else {
            $icon = '<img width="25" src="' . defAdminAssets('img/active_un.webp') . '">';
        }
        return $icon;
    }
}
if (!function_exists('print_h1')) {
    function print_h1($row, $name = 'name', $hasLang = true) {
        if ($hasLang) {
            $app_lang = LaravelLocalization::getCurrentLocale();
            if ($app_lang == 'ar') {
                $changeLang = "en";
            } else {
                $changeLang = "ar";
            }
            return $row->translate($app_lang)->$name ?? $row->translate($changeLang)->$name ?? '';
        } else {
            return $row->$name ?? '';
        }
    }
}
if (!function_exists('printUploadNotes')) {
    function printUploadNotes($thisfilterid) {
//        if (config('app.upload_photo_notes') == true and intval($thisfilterid) != 0) {
//            $notesSend = UploadFilter::where('id', $thisfilterid)->first();
//            $printName = "notes_" . thisCurrentLocale();
//            return $notesSend->$printName ?? '';
//        }
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getButSize')) {
    function getButSize($val) {
        switch ($val) {
            case 's':
                $sendStyle = "btn-sm";
                break;
            case 'm':
                $sendStyle = "btn-md";
                break;
            case 'l':
                $sendStyle = "btn-lg";
                break;

            default:
                $sendStyle = "btn-sm";
        }
        return $sendStyle;
    }
}
if (!function_exists('getBgColor')) {
    function getBgColor($val) {
        switch ($val) {
            case 'def':
                $sendColor = "default";
                break;
            case 'dark':
                $sendColor = "dark";
                break;
            case 'p':
                $sendColor = "primary";
                break;
            case 'se':
                $sendColor = "secondary";
                break;
            case 's':
                $sendColor = "success";
                break;
            case 'i':
                $sendColor = "info";
                break;
            case 'd':
                $sendColor = "danger";
                break;
            case 'w':
                $sendColor = "warning";
                break;
            case 'l':
                $sendColor = "light";
                break;
            default:
                $sendColor = "dark";
        }
        return $sendColor;
    }
}
if (!function_exists('getResponsiveType')) {
    function getResponsiveType($val) {
        switch ($val) {
            case 'a':
                $sendType = "all";
                break;
            case 'd':
                $sendType = "desktop";
                break;
            case 'm':
                $sendType = "mobile";
                break;
            case 'n':
                $sendType = "none";
                break;
            default:
                $sendType = "all";
        }
        return $sendType;
    }
}
if (!function_exists('getAlign')) {
    function getAlign($val) {
        $sendStyle = "";
        if ($val == 'c') {
            $sendStyle = "center";
        } elseif ($val == 'r') {
            $sendStyle = "right";
        } elseif ($val == 'l') {
            $sendStyle = "left";
        }
        return $sendStyle;
    }
}
if (!function_exists('getColDir')) {
    function getColDir($key, $sendArr = array()) {
        $currentDir = "";
        if ($key == 'ar' and thisCurrentLocale() == 'en') {
            $currentDir = ' order-last ';
        }
        return $currentDir;
    }
}
if (!function_exists('getColLang')) {
    function getColLang($crunt, $willBe = null) {
        if (count(config('app.web_lang')) >= 2) {
            $send = $crunt;
        } else {
            if ($willBe != null) {
                $send = $willBe;
            } else {
                $send = $crunt * 2;
            }
        }
        return $send;
    }
}
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
if (!function_exists('isSetKeyForLang')) {
    function isSetKeyForLang($key) {
        if (isset($_GET['key']) and $_GET['key'] == $key) {
            return "ThisSelectLang";
        } else {
            return '';
        }

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

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

