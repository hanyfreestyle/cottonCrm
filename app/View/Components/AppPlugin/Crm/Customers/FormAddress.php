<?php

namespace App\View\Components\AppPlugin\Crm\Customers;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormAddress extends Component {

    public $rowData;
    public $title;
    public $config;


    public function __construct(
        $rowData = array(),
        $title = null,
        $config = array(),


    ) {
        $this->rowData = $rowData;
        $this->title = $title;


        if (!$rowData->country_id) {
            $rowData->country_id = $config['defCountryId'];
        }


        $Citylist = City::where('country_id', old('country_id', $rowData->country_id))->get();
        \Illuminate\Support\Facades\View::share('Citylist', $Citylist);


        $Arealist = Area::where('city_id', old('city_id', $rowData->city_id))->get();
        \Illuminate\Support\Facades\View::share('Arealist', $Arealist);
    }


    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.customers.form-address');
    }
}
