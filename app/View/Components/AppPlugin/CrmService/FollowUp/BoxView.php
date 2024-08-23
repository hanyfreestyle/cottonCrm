<?php

namespace App\View\Components\AppPlugin\CrmService\FollowUp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BoxView extends Component {

    public $row;
    public $collapsed;
    public $collapsed_style;
    public $open;
    public $open_style;
    public $isactive;
    public $bg;


    public function __construct(
        $row = array(),
        $collapsed = true,
        $open = true,
        $isactive = true,
        $bg = "bg-success",

    ) {
        $this->row = $row;
        $this->collapsed = $collapsed;

        if ($row->follow_state == 1 or $row->follow_state == '2') {
            $this->bg = $bg;
        } elseif ($row->follow_state == 3) {
            $this->bg = 'bg-dark';
        } elseif ($row->follow_state == 4) {
            $this->bg = 'bg-warning';
        } elseif ($row->follow_state == 5 or $row->follow_state == 6) {
            $this->bg = 'bg-danger';
        }


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

    }


    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.follow-up.box-view');
    }
}
