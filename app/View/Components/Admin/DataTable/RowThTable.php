<?php

namespace App\View\Components\Admin\DataTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RowThTable extends Component {
    public $l;
    public $res;
    public $but;
    public $can;
    public $dbTable;
    public $setName;


    public function __construct(
        $l = null,
        $res = 'd',
        $but = false,
        $can = 'view',
        $dbTable = null,
        $setName = null,
    ) {
        $this->l = $l;
        $this->res = getResponsiveType($res);


        if ($but) {
            $this->but = " td_action ";
        } else {
            $this->but = "";
        }
        $this->can = $can;
        $this->dbTable = $dbTable;
        $this->setName = $setName;
    }

    public function render(): View|Closure|string {
        return view('components.admin.data-table.row-th-table');
    }
}
