<?php

namespace App\View\Components\AppPlugin\CrmService\Leads;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserChange extends Component {

    public $row;


    public function __construct(
        $row = array(),

    ) {
        $this->row = $row;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.leads.user-change');
    }
}
