<?php

namespace App\View\Components\AppPlugin\CrmService\Leads;

use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeadInfo extends Component {

    public $row;
    public $isactive;
    public $addTitle;
    public $softView;
    public $viewList;
    public $ticketId;
    public $addDes;
    public $cashInfo;



    public function __construct(
        $row = array(),
        $isactive = true,
        $addTitle = false,
        $softView = false,
        $viewList = 'icon',
        $ticketId = null,
        $addDes = false,
        $cashInfo = [],

    ) {
        $this->ticketId = $ticketId;
        $this->addDes = $addDes;

        if($ticketId > 0 ){
            $this->row = CrmTickets::query()->where('id',$ticketId)->with('des')->first();
            $this->cashInfo = CrmTicketsCash::query()->where('ticket_id',$ticketId)->get();
        }else{
            $this->row = $row;
            $this->cashInfo = $cashInfo;
        }
        $this->isactive = $isactive;
        $this->addTitle = $addTitle;
        $this->softView = $softView;
        $this->viewList = $viewList;


    }



    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.leads.lead-info');
    }
}
