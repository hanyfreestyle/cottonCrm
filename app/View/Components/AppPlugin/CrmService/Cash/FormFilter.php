<?php

namespace App\View\Components\AppPlugin\CrmService\Cash;

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

    public function __construct(
        $defRoute = '.filter',
        $row = array(),
        $formName = null,


    ) {
        $this->defRoute = $defRoute;
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);


    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.cash.form-filter');
    }
}
