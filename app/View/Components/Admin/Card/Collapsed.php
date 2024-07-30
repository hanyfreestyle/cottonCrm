<?php

namespace App\View\Components\Admin\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Collapsed extends Component {

    public $row;
    public $outline;
    public $title;
    public $collapsed;
    public $collapsed_style;
    public $open;
    public $open_style;
    public $bg;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $outline = true,
        $title = null,
        $collapsed = true,
        $open = false,
        $bg = 'p',
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->title = $title;

        if ($outline) {
            $this->outline = "card-outline";
        } else {
            $this->outline = "";
        }
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

        $this->bg = getBgColor($bg);


        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.card.collapsed');
    }
}
