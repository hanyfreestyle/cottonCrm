<?php

namespace App\View\Components\Admin\WebConfig;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component {

    public $model;
    public $isactive;
    public $col;
    public $row;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $model = null,
        $isactive = true,
        $col = null,
        $row = array(),
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->model = $model;
        $this->isactive = $isactive;
        $this->col = $col;
        $this->row = $row;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.web-config.form');
    }
}
