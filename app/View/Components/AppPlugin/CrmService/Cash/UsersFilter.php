<?php

namespace App\View\Components\AppPlugin\CrmService\Cash;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class UsersFilter extends Component {

    public $defRoute;
    public $row;
    public $getSessionData;

    public function __construct(
        $defRoute = '.UserListFilter',
        $row = array(),
        $formName = null,


    ) {
        $this->defRoute = $defRoute;
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);


    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.cash.users-filter');
    }
}
