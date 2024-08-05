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
    public $vType;
    public $i;
    public $subDes;
    public $s;


    public function __construct(
        $t = null,
        $des = null,
        $col = null,

        $arrData = null,
        $allData = true,
        $vType = "text",
        $i = null,
        $subDes = false,
        $s = null,

    ) {
        $this->t = $t;
        $this->i = $i;
        $this->s = $s;


        $this->col =  $col;

        $this->arrData = $arrData;
        $this->allData = $allData;
        $this->vType = $vType;
        $this->subDes = $subDes;


        if ($this->arrData) {
            if (is_array($this->arrData)) {
                $this->arrData = collect($this->arrData);
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
