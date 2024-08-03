<?php

namespace App\View\Components\Admin\Java;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectAllTable extends Component {

    public $row;
    public $isactive;


    public function __construct(
        $row = array(),
        $isactive = true,

    ) {
        $this->row = $row;
        $this->isactive = $isactive;

    }

    public function render(): View|Closure|string {
        return view('components.admin.java.select-all-table');
    }
}
