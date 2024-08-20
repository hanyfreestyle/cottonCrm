<?php

namespace App\View\Components\Admin\FilterCard;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Def extends Component {

    public $row;
    public $formName;
    public $getSessionData;
    public $isActive;
    public $formDates;
    public $exportBut;
    public $exportRoute;

    public function __construct(
        $row = array(),
        $formName = null,
        $isActive = false,
        $formDates = false,
        $exportBut = false,
        $exportRoute = '.Export',


    ) {
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);
        $this->isActive = $isActive;
        $this->formDates = $formDates;
        $this->exportBut = $exportBut;
        $this->exportRoute = $exportRoute;

    }

    public function render(): View|Closure|string {
        return view('components.admin.filter-card.def');
    }
}
