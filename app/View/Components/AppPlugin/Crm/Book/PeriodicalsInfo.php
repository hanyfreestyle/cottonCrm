<?php

namespace App\View\Components\AppPlugin\Crm\Book;

use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PeriodicalsInfo extends Component {

    public $row;


    public function __construct(
        $row = array(),

    ) {
        $this->row = $row;

    }

    public function render(): View|Closure|string {
        $configData = ConfigData::all();
        return view('components.app-plugin.crm.book.periodicals-info', compact('configData'));
    }
}
