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
    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $rowData = array(),
        $title = null,


        $option_1 = null,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->rowData = $rowData;
        $this->title = $title;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;

        $Citylist = City::where('country_id', old('country_id',$rowData->country_id))->get();
        \Illuminate\Support\Facades\View::share('Citylist', $Citylist);


        $Arealist = Area::where('city_id',  old('city_id',$rowData->city_id))->get();
        \Illuminate\Support\Facades\View::share('Arealist', $Arealist);
    }


    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.customers.form-address');
    }
}
