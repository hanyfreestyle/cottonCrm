<?php

namespace App\View\Components\AppPlugin\CrmService\Cash;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GetCard extends Component {

    public $row;
    public $bg;
    public $mass;


    public function __construct(
        $row = array(),
        $bg = "p",
        $mass = null,
    ) {
        $this->row = $row;
        $this->bg = 'bg-' . getBgColor($bg);


        $Mass = __('admin/crm_service.label_cash_confirm_mass');
        $rep = ['[username]', '[amount]'];
        $rep_r = [
            '<span class="get_cash_user_name">' . $row->user->name . '</span>',
            '<span class="get_cash_amount">' . number_format($row->amount) . '</span>',

        ];
        $sendMass = str_replace($rep, $rep_r, $Mass);
        $this->mass = $sendMass;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.cash.get-card');
    }
}
