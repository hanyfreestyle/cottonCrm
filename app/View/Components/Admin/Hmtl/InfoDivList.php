<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoDivList extends Component {

    public $n;
    public $viewList;
    public $row;
    public $allData;
    public $col;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $n = null,
        $viewList = 'icon',
        $row = array(),
        $allData = false,
        $col = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->n = $n;
        $this->viewList = $viewList;
        $this->row = $row;
        $this->allData = $allData;
        $this->col = $col;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.hmtl.info-div-list');
    }
}
