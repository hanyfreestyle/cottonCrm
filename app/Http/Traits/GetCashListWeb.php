<?php

namespace App\Http\Traits;

use App\AppPlugin\Config\Meta\MetaTag;
use App\AppCore\DefPhoto\DefPhoto;
use App\AppCore\WebSettings\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

trait GetCashListWeb {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getWebConfig($stopCash = 0) {
        if ($stopCash) {
            $WebConfig = Setting::where('id', 1)->with('translation')->first();
        } else {
            $WebConfig = Cache::remember('WebConfig_Cash', cashDay(1), function () {
                return Setting::where('id', 1)->with('translation')->first();
            });
        }
        return $WebConfig;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getDefPhotoList($stopCash = 0) {
        if ($stopCash) {
            $DefPhotoList = DefPhoto::get()->keyBy('cat_id');
        } else {
            $DefPhotoList = Cache::remember('DefPhotoList_Cash', cashDay(7), function () {
                return DefPhoto::get()->keyBy('cat_id');
            });
        }
        return $DefPhotoList;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getDefPhotoById($cat_id) {
        $DefPhoto = self::getDefPhotoList(0);
        if ($DefPhoto->has($cat_id)) {
            return $DefPhoto[$cat_id];
        } else {
            return $DefPhoto['dark_logo'] ?? '';
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getMeatByCatId($cat_id) {
        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $WebMeta = Cache::remember('WebMeta_Cash', cashDay(7), function () {
                return MetaTag::with('translation')->get()->keyBy('cat_id');
            });
            if ($WebMeta->has($cat_id)) {
                return $WebMeta[$cat_id];
            } else {
                return $WebMeta['home'] ?? '';
            }
        } else {
            return [];
        }
    }


}
