<?php

namespace App\View\Components\AppPlugin\CrmService\Cash;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChartYear extends Component {

    public $chartData;


    public function __construct(
        $chartData = array(),

    ) {
        $this->chartData = $chartData;

    }


    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.cash.chart-year');
    }
}
