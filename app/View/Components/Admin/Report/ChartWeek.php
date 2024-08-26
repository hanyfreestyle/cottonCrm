<?php

namespace App\View\Components\Admin\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChartWeek extends Component {

    public $chartData;

    public function __construct(
        $chartData = array(),
    ) {
        $this->chartData = $chartData;
    }

    public function render(): View|Closure|string {
        return view('components.admin.report.chart-week');
    }
}
