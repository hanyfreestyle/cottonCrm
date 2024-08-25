<?php

namespace App\View\Components\Admin\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SessionChart extends Component
{

    public $id;
    public $l;
    public $i;
    public $key;
    public $count;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $id = null,
        $l = null,
        $i = " fas fa-thumbtack ",
        $key = null,
        $count = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->id = $id;
        $this->l = $l;
        $this->i = $i;
        $this->key = $key;
        $this->count = $count;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.report.session-chart');
    }
}
