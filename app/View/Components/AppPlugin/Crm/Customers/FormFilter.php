<?php

namespace App\View\Components\AppPlugin\Crm\Customers;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FormFilter extends Component {

    public $row;
    public $config;
    public $formName;
    public $getSessionData;
    public $cityId;
    public $cityList;
    public $areaList;

    public function __construct(
        $row = array(),
        $config = array(),
        $formName = null,
        $cityList = array(),
        $areaList = array(),

    ) {
        $this->row = $row;
        $this->config = $config;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);

        if (issetArr($config,'OneCountry')) {
            $this->cityList = City::where('country_id', intval($config['defCountryId']))->get();
        } else {
            if (isset($this->getSessionData['country_id']) and intval($this->getSessionData['country_id']) > 0) {
                $this->cityList = City::where('country_id', intval($this->getSessionData['country_id']))->get();
            } else {
                $this->cityList = $cityList;
            }
        }


        if (isset($this->getSessionData['city_id']) and intval($this->getSessionData['city_id']) > 0) {
            $this->areaList = Area::where('city_id', intval($this->getSessionData['city_id']))->get();
        } else {
            $this->areaList = $areaList;
        }
    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.customers.form-filter');
    }
}
