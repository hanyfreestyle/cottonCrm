<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopupModal extends Component {

    public $id;
    public $title;
    public $option_1;
    public $option_2;

    public function __construct(
        $id = null,
        $title = null,
        $option_1 = null,
        $option_2 = null,

    ) {
        $this->id = $id;
        $this->title = $title;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;

    }

    public function render(): View|Closure|string {
        return view('components.admin.hmtl.popup-modal');
    }
}
