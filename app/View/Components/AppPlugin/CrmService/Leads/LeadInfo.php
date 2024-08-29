<?php

namespace App\View\Components\AppPlugin\CrmService\Leads;

use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
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


    public function __construct(
        $row = array(),
        $isactive = true,
        $addTitle = false,
        $softView = false,
        $viewList = 'icon',
        $ticketId = null,
    ) {
        $this->ticketId = $ticketId;

        if($ticketId > 0 ){
            $this->row = CrmTickets::query()->where('id',$ticketId)->first();
        }else{
            $this->row = $row;
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
