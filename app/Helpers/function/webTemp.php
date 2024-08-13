<?php
use App\Http\Controllers\WebMainController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if(!function_exists('defWebAssets')) {
    function defWebAssets($path, $secure = null): string {
        return app('url')->asset('assets/web/' . $path, $secure);
    }
}
if(!function_exists('underAssets')) {
    function underAssets($path, $secure = null): string {
        return app('url')->asset('assets/under/' . $path, $secure);
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if(!function_exists('getPhotoPath')) {
    function getPhotoPath($file, $defPhoto = "dark_logo", $defPhotoThum = "photo") {
        $defPhoto_file = WebMainController::getDefPhotoById($defPhoto);
        if($file) {
            $sendImg = defImagesDir($file);
        } else {
            $sendImg = defImagesDir($defPhoto_file->$defPhotoThum ?? '');
        }
        return $sendImg;
    }
}
if(!function_exists('getDefPhotoPath')) {
    function getDefPhotoPath($DefPhotoList, $cat_id, $defPhotoThum = "photo") {
        if($DefPhotoList->has($cat_id)) {
            $file = $DefPhotoList[$cat_id][$defPhotoThum];
            $sendImg = defImagesDir($file);
        } else {
            $sendImg = "";
        }
        return $sendImg;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if(!function_exists('webChangeLocale')) {
    function webChangeLocale() {
        $Current = LaravelLocalization::getCurrentLocale();
        if($Current == 'ar') {
            $change = 'en';
        } else {
            $change = 'ar';
        }
        return $change;
    }
}
if(!function_exists('webChangeLocaletext')) {
    function webChangeLocaletext() {
        $Current = LaravelLocalization::getCurrentLocale();
        if($Current == 'ar') {
            $change = 'English';
        } else {
            $change = 'عربى';
        }
        return $change;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if(!function_exists('GetCopyRight')) {
    function GetCopyRight($StartDate, $CompanyName) {
        if($StartDate > date("Y")) {
            $StartDate = date("Y");
        }
        $Lang = LaravelLocalization::getCurrentLocale();
        switch ($Lang) {
            case 'ar':
                $copyname = "جميع الحقوق محفوظة";
                if($StartDate == date("Y")) {
                    $CopyRight = $copyname . " &copy; " . date("Y") . ' <span class="clr-tertiary-300">' . $CompanyName . '</span>';
                } else {
                    $CopyRight = $copyname . '<span class="En_Font footerYears">' . " &copy; " . $StartDate . " - " . date("Y")
                        . '</span> <span class="clr-tertiary-300">' . $CompanyName . '</span>';
                }
                break;
            default:
                $copyname = "All Rights Reserved";
                if($StartDate == date("Y")) {
                    $CopyRight = $copyname . " &copy; " . date("Y") . ' <span class="clr-tertiary-300">' . $CompanyName . '</span>';
                } else {
                    $CopyRight = $copyname . " &copy; " . $StartDate . " - " . date("Y") . ' <span class="clr-tertiary-300">'
                        . $CompanyName . '</span>';
                }
        }
        return $CopyRight;
    }
}
if(!function_exists('ChangeText')) {
    function ChangeText($value) {
        $WebConfig = WebMainController::getWebConfig();
        $CompanyName = '<span>' . $WebConfig->name . '</span>';
        $webEmail = '<span>' . $WebConfig->email . '</span>';
        $def_url = '<span>' . $WebConfig->def_url . '</span>';
        $rep1 = array("[CompanyName]", "[WebSiteName]", "[WebEmail]");
        $rep2 = array($CompanyName, $def_url, $webEmail);
        $value = str_replace($rep1, $rep2, $value);
        return $value;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if(!function_exists('activeMenu')) {
    function activeMenu($pageView, $selMenu) {
        if($pageView['SelMenu'] == $selMenu) {
            $setActive = 'setActive';
        } else {
            $setActive = '';
        }
        return $setActive;
    }
}
if(!function_exists('activeProfileMenu')) {
    function activeProfileMenu($pageView, $selMenu) {
        if(isset($pageView['profileMenu'])){
            if($pageView['profileMenu'] == $selMenu) {
                $setActive = 'setActive';
            } else {
                $setActive = '';
            }
        }else{
            $setActive = '';
        }

        return $setActive;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
