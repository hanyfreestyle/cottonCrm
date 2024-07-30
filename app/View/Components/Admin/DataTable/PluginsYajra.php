<?php

namespace App\View\Components\Admin\DataTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PluginsYajra extends Component {

    public $style;
    public $jscode;


    public function __construct(
        $style = false,
        $jscode = false,

    ) {
        $this->style = $style;
        $this->jscode = $jscode;

    }

    public function render(): View|Closure|string {
        return view('components.admin.data-table.plugins-yajra');
    }
}
