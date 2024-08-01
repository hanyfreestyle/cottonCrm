<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrintErrorDiv extends Component {

    public $printErr;
    public $fullErr;

    public function __construct(
        $printErr = true,
        $fullErr = false,

    ) {
        $this->printErr = $printErr;
        $this->fullErr = $fullErr;
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.print-error-div');
    }
}
