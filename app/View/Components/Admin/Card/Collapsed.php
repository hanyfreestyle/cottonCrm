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
    public $filter;
    public $header_filter;

    public function __construct(
        $row = array(),
        $outline = true,
        $title = null,
        $collapsed = true,
        $open = false,
        $bg = 'p',
        $filter = false,
        $header_filter = null,
    ) {
        $this->row = $row;
        $this->title = $title;
        $this->header_filter = $header_filter;

        if ($filter) {
            $outline = false;
            $this->title = __('admin/formFilter.box_total') . ' ' . number_format($row->count());
            $this->header_filter = 'card_header_filter';
        }


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


    }

    public function render(): View|Closure|string {
        return view('components.admin.card.collapsed');
    }
}
