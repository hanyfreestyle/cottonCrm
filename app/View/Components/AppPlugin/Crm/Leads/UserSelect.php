<?php

namespace App\View\Components\AppPlugin\Crm\Leads;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserSelect extends Component {


    public $type;
    public $row;
    public $label;
    public $req;
    public $col;
    public $labelview;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $type = null,
        $row = array(),
        $req = true,
        $col = '3',
        $labelview = true,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->type = $type;
        $this->req = $req;

        if ($this->type == 'tech'){
            $this->label = __('admin/crm/ticket.fr_user_id');
            $this->row = User::query()->where('crm_tech',true)->get();
        }






        $this->col = $col;
        $this->labelview = $labelview;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.leads.user-select');
    }
}
