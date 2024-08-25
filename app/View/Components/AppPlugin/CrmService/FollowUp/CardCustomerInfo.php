<?php

namespace App\View\Components\AppPlugin\CrmService\FollowUp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardCustomerInfo extends Component {

    public $ticket;
    public $open;
    public $outline;
    public $bg;
    public $option_3;
    public $option_4;


    public function __construct(
        $ticket = array(),
        $open = true,
        $outline = true,
        $bg = "p",
        $option_3 = null,
        $option_4 = null,

    ) {
        $this->ticket = $ticket;
        $this->open = $open;
        $this->outline = $outline;
        $this->bg = $bg;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.follow-up.card-customer-info');
    }
}
