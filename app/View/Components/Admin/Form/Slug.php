<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slug extends Component {

    public $row;
    public $viewtype;
    public $key;
    public $labelView;
    public $col;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $viewtype = null,
        $key = null,
        $labelView = true,
        $col = 6,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->viewtype = $viewtype;
        $this->key = $key;
        $this->labelView = $labelView;
        $this->col = $col;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.slug');
    }
}
