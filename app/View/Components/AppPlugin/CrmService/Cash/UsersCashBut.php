<?php

namespace App\View\Components\AppPlugin\CrmService\Cash;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsersCashBut extends Component {

    public $row;
    public $amount;
    public $id;
    public $mass;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $amount = 0,
        $id = null,
        $mass = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->amount = $amount;
        $this->id = $id;


        $Mass = __('admin/crm_service_cash.label_confirm_mass');
        $rep = ['[username]', '[amount]'];
        $rep_r = [
            '<span class="get_cash_user_name">' . $row->user->name . '</span>',
            '<span class="get_cash_amount">' . number_format($amount) . '</span>',
        ];

        $sendMass = str_replace($rep, $rep_r, $Mass);
        $this->mass = $sendMass;
    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.cash.users-cash-but');
    }
}
