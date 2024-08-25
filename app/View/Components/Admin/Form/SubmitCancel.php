<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubmitCancel extends Component {

    public $backTo;
    public $isactive;
    public $option_1;
    public $option_2;


    public function __construct(
        $backTo = null,
        $isactive = true,
        $option_1 = null,
        $option_2 = null,

    ) {
        $this->backTo = $backTo;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.submit-cancel');
    }
}
