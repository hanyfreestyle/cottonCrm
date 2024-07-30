<?php

namespace App\View\Components\AppPlugin\Crm\Customers;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardProfile extends Component {

    public $row;
    public $allData;
    public $config;
    public $softData;

    public function __construct(
        $row = array(),
        $allData = true,
        $config = array(),
        $softData = false,

    ) {
        $this->row = $row;
        $this->allData = $allData;
        $this->config = $config;
        $this->softData = $softData;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.customers.card-profile');
    }
}
