<?php

namespace App\View\Components\AppPlugin\Crm\Leads;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeadInfo extends Component {

    public $row;
    public $isactive;
    public $addTitle;
    public $softView;
    public $viewList;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $isactive = true,
        $addTitle = false,
        $softView = false,
        $viewList = 'icon',
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->addTitle = $addTitle;
        $this->softView = $softView;
        $this->viewList = $viewList;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.leads.lead-info');
    }
}
