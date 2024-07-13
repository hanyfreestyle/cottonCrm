<?php

namespace App\View\Components\Admin\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColorCard extends Component {


    public $bg;
    public $title;
    public $count;
    public $icon;
    public $url;


    public function __construct(

        $bg = "p",
        $title = 'text',
        $count = 0,
        $icon = null,
        $url = null,


    ) {

        $this->bg = getBgColor($bg);
        $this->title = $title;
        $this->count = intval($count);
        $this->icon = $icon;
        $this->url = $url;

    }

    public function render(): View|Closure|string {
        return view('components.admin.dashboard.color-card');
    }
}
