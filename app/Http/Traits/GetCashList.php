<?php

namespace App\Http\Traits;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\Country\Country;
use App\Models\User;
use App\AppPlugin\Product\Models\Brand;
use Illuminate\Support\Facades\Cache;

trait GetCashList {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashConfigDataList($stopCash = 0) {
        if ($stopCash) {
            $CashConfigDataList = ConfigData::with('translation')->get();
        } else {
            $CashConfigDataList = Cache::remember('CashConfigDataList', cashDay(7), function () {
                return ConfigData::with('translation')->get();
            });
        }
        return $CashConfigDataList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashCountryList($stopCash = 0) {
        if ($stopCash) {
            $CashCountryList = Country::select('id', 'iso2')->with('translation')->orderByTranslation('name', 'ASC')->get();
        } else {
            $CashCountryList = Cache::remember('CashCountryList', cashDay(7), function () {
                return Country::select('id', 'iso2')->with('translation')->orderByTranslation('name', 'ASC')->get();
            });
        }
        return $CashCountryList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashCityList($stopCash = 0) {
        if ($stopCash) {
            $CashCityList = City::with('translation')->orderby('postion')->get();
        } else {
            $CashCityList = Cache::remember('CashCityList', cashDay(7), function () {
                return City::with('translation')->orderby('postion')->get();
            });
        }
        return $CashCityList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashAreaList($stopCash = 0) {
        if ($stopCash) {
            $CashAreaList = Area::with('translation')->get();
        } else {
            $CashAreaList = Cache::remember('CashAreaList', cashDay(7), function () {
                return Area::with('translation')->get();
            });
        }
        return $CashAreaList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashUsersList($stopCash = 0) {
        if ($stopCash) {
            $CashUsersList = User::get();
        } else {
            $CashUsersList = Cache::remember('CashUsersList', cashDay(7), function () {
                return User::get();
            });
        }
        return $CashUsersList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashBrandList($stopCash = 0) {
        if ($stopCash) {
            $CashBrandList = Brand::CashBrandList();
        } else {
            $CashBrandList = Cache::remember('CashBrandList', cashDay(7), function () {
                return Brand::CashBrandList();
            });
        }
        return $CashBrandList;
    }
}
