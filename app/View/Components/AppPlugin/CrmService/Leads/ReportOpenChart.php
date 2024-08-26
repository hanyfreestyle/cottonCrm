<?php

namespace App\View\Components\AppPlugin\CrmService\Leads;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReportOpenChart extends Component {

    public $card;
    public $chartData;
    public $reportView;


    public function __construct(
        $card = array(),
        $chartData = array(),
        $reportView = false,

    ) {
        $this->card = $card;
        $this->chartData = $chartData;
        $this->reportView = $reportView;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.leads.report-open-chart');
    }
}
