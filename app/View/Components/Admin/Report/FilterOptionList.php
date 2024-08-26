<?php

namespace App\View\Components\Admin\Report;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterOptionList extends Component {

    public $session;

    public function __construct(
        $session = array(),

    ) {
        $this->session = $session;
    }

    public function render(): View|Closure|string {
        return view('components.admin.report.filter-option-list');
    }
}
