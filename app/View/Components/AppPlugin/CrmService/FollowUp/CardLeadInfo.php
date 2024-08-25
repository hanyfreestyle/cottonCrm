<?php

namespace App\View\Components\AppPlugin\CrmService\FollowUp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardLeadInfo extends Component {

    public $ticket;
    public $open;
    public $outline;
    public $bg;
    public $fullInfo;
    public $option_4;


    public function __construct(
        $ticket = array(),
        $open = true,
        $outline = true,
        $bg = "p",
        $fullInfo = false,
        $option_4 = null,

    ) {
        $this->ticket = $ticket;
        $this->open = $open;
        $this->outline = $outline;
        $this->bg = $bg;
        $this->fullInfo = $fullInfo;
        $this->option_4 = $option_4;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.follow-up.card-lead-info');
    }
}
