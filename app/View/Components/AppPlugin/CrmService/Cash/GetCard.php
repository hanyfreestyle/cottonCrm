<?php

namespace App\View\Components\AppPlugin\CrmService\Cash;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GetCard extends Component {

    public $row;
    public $bg;
    public $mass;
    public $collapsed;
    public $collapsed_style;
    public $open;
    public $open_style;
    public $isactive;




    public function __construct(
        $row = array(),
        $bg = "p",
        $mass = null,
        $collapsed = true,
        $open = true,
        $isactive = true,

    ) {
        $this->row = $row;
        $this->bg = 'bg-' . getBgColor($bg);
        $this->collapsed = $collapsed;
        if ($collapsed) {
            if ($open) {
                $this->collapsed_style = "";
            } else {
                $this->collapsed_style = "collapsed-card";
            }
        } else {
            $this->collapsed_style = "";
        }
        $this->open = $open;

        if ($this->open) {
            $this->open_style = "fas fa-minus";
        } else {
            $this->open_style = "fas fa-plus";
        }
        $this->isactive = $isactive;


        $Mass = __('admin/crm_service_cash.label_confirm_mass');
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
