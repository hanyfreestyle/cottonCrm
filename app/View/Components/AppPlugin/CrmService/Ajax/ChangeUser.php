<?php

namespace App\View\Components\AppPlugin\CrmService\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChangeUser extends Component {

    public $id;
    public $title;
    public $route;

    public function __construct(
        $id = 'ticketChangeUser',
        $title = null,
        $route = null,

    ) {
        $this->id = $id;

        if ($title) {
            $this->title = $title;
        } else {
            $this->title = __('admin/crm_service.change_user_but');
        }

        if ($route) {
            $this->route = $route;
        } else {
            $this->route = 'admin.CrmCore.ChangeUser';
        }

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.ajax.change-user');
    }
}
