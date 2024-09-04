<?php

namespace App\AppPlugin\Crm\CrmService\Tickets;

use App\AppPlugin\Crm\CrmService\Leads\Traits\CrmLeadsConfigTraits;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\View;

class CrmTicketInfoController extends AdminMainController {

    use CrmLeadsConfigTraits;

    function __construct() {
        parent::__construct();
        $this->config = self::defConfig();
        View::share('config', $this->config);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TicketInfo($id) {
        $ticket = CrmTickets::findOrFail($id);
        return view('AppPlugin.CrmService.ticketInfo.ajax_view_info', compact('ticket'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ChangeUser($id) {
        $ticket = CrmTickets::findOrFail($id);
        return view('AppPlugin.CrmService.ticketInfo.ajax_change_user', compact('ticket'));
    }

}
