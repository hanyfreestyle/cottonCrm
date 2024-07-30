<?php

namespace App\View\Components\AppPlugin\Crm\Book;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FormReleaseFilter extends Component {

    public $row;
    public $formName;
    public $getSessionData;


    public function __construct(
        $row = array(),
        $formName = null,


    ) {
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);
    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.book.form-release-filter');
    }
}
