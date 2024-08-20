<?php

namespace App\View\Components\Admin\Form;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component {

    public $label;
    public $labelview;
    public $name;
    public $reqspan;
    public $id;
    public $col;
    public $colMobile;
    public $value;

    public function __construct(
        $name = null,
        $label = null,
        $labelview = true,
        $reqspan = true,
        $id = null,
        $col = null,
        $colMobile = null,
        $value = null,
        $type = null,
    ) {

        $this->col = getCol($col);
        $this->colMobile = getColMobile($colMobile);

        if ($type == 'fromDate') {
            $this->name = 'from_date';
            $this->label = __('admin/formFilter.fr_date_from');
            $this->reqspan = false;

        } elseif ($type == 'toDate') {
            $this->name = 'to_date';
            $this->label = __('admin/formFilter.fr_date_to');
            $this->reqspan = false;
        } else {
            $this->name = $name;
            $this->label = $label;
            $this->reqspan = $reqspan;
        }


        if ($id == null) {
            $this->id = $this->name;
        } else {
            $this->id = $id;
        }

        $this->labelview = $labelview;


        if ($value == null) {
            $this->value = '';
        } else {
            if (CheckDateFormatState($value)) {
                $this->value = Carbon::parse($value)->format("Y-m-d");
            } else {
                $this->value = '';
            }
        }
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.date');
    }
}
