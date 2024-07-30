<?php

namespace App\View\Components\Admin\Hmtl;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoDiv extends Component {

    public $t;
    public $des;
    public $col;
    public $colRow;
    public $arrData;
    public $allData;


    public function __construct(
        $t = null,
        $des = null,
        $col = 3,
        $colRow = null,
        $arrData = null,
        $allData = true,

    ) {
        $this->t = $t;

        $this->col = "col-lg-" . $col;
        $this->colRow = $colRow;
        $this->arrData = $arrData;
        $this->allData = $allData;


        if ($this->arrData) {
            if (is_array($this->arrData)){
                $this->arrData = collect($this->arrData) ;
            }
            $this->des = $this->arrData->where('id', $des)->first()->name ?? '';
        } else {
            $this->des = $des;
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.hmtl.info-div');
    }
}
