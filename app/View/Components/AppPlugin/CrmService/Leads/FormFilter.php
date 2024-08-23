<?php

namespace App\View\Components\AppPlugin\CrmService\Leads;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FormFilter extends Component {

    public $defRoute;
    public $row;
    public $getSessionData;
    public $config;
    public $cityList;
    public $areaList;
    public $viewDates;
    public $dateAdd;
    public $dateFollow;


    public function __construct(
        $defRoute = '.filter',
        $row = array(),
        $formName = null,
        $config = array(),
        $cityList = array(),
        $areaList = array(),
        $viewDates = true,
        $dateAdd = true,
        $dateFollow = true,

    ) {
        $this->defRoute = $defRoute;
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);
        $this->config = $config;
        $this->viewDates = $viewDates;
        $this->dateAdd = $dateAdd;
        $this->dateFollow = $dateFollow;

        if (issetArr($config, 'OneCountry')) {
            $this->cityList = City::where('country_id', intval($config['defCountryId']))->with('translation')->get();
        } else {
            if (isset($this->getSessionData['country_id']) and intval($this->getSessionData['country_id']) > 0) {
                $this->cityList = City::where('country_id', intval($this->getSessionData['country_id']))->get();
            } else {
                $this->cityList = $cityList;
            }
        }

        if (isset($this->getSessionData['city_id']) and intval($this->getSessionData['city_id']) > 0) {
            $this->areaList = Area::where('city_id', intval($this->getSessionData['city_id']))->with('translation')->get();
        } else {
            $this->areaList = $areaList;
        }
    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.leads.form-filter');
    }
}
