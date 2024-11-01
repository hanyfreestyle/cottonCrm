<?php

namespace App\View\Components\Admin\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Settings extends Component {
    public $modelname;
    public $configArr;
    public $pageData;


    public function __construct(
        $modelname = null,
        $configArr = array(),
        $pageData = array(),

    ) {
        $this->modelname = $modelname;
        $this->configArr = $configArr;
        $this->pageData = $pageData;

    }

    public function render(): View|Closure|string {
        return view('components.admin.main.settings');
    }
}
