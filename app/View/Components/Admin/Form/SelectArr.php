<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SelectArr extends Component {
    public $name;
    public $label;
    public $sendvalue;
    public $requiredSpan;
    public $col;
    public $colrow;
    public $sendArr;
    public $selectType;
    public $printValName;
    public $labelview;
    public $applang;
    public $changelang;
    public $sendid;
    public $addFilde;

    public function __construct(
        $name = "",
        $label = "",
        $sendvalue = "",
        $requiredSpan = true,
        $col = "4",
        $colrow = null,

        $sendArr = array(),
        $selectType = 'normal',
        $printValName = 'name',
        $labelview = true,
        $applang = null,
        $changelang = null,
        $sendid = 'id',
        $addFilde = null,

    ) {
        $this->name = $name;
        $this->label = $label;
        $this->printValName = $printValName;
        $this->sendvalue = $sendvalue;
        $this->requiredSpan = $requiredSpan;
        $this->colrow = $colrow;
        $this->col = "col-lg-" . $col;

        $this->sendArr = $sendArr;
        $this->selectType = $selectType;

        $this->labelview = $labelview;
        $this->sendid = $sendid;

        $this->applang = LaravelLocalization::getCurrentLocale();
        if ($this->applang == 'ar') {
            $this->changelang = 'en';
        } else {
            $this->changelang = 'ar';
        }

        $this->addFilde = $addFilde;


    }

    public function render(): View|Closure|string {
        return view('components.admin.form.select-arr');
    }
}
