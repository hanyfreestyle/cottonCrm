<?php

namespace App\View\Components\AppPlugin\CrmService\Leads;

use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class LeadInfoClosed extends Component {

    public $row;
    public $sendData;
    public $ticketId;


    public function __construct(
        $row = array(),
        $ticketId = null,
    ) {
        $this->row = $row;

        if($ticketId > 0 ){
            $this->row = CrmTickets::query()->where('id',$ticketId)->withSum('customerAmount','amount')->first();
        }else{
            $this->row = $row;
        }

        $sendData = [];
        if ( $this->row->review_state == 1) {
            $sendData['review_text'] = __('admin/crm.label_review_1');
            $sendData['review_bg'] = ' bg-success ';
        } else {
            $sendData['review_text'] = __('admin/crm.label_review_0');
            $sendData['review_bg'] = 'bg-warning ';
        }


        if ($this->row->follow_state == 2) {
            $sendData['state_text'] = __('admin/crm_service_var.ticket_state_2');
            $sendData['state_bg'] = ' bg-success ';
            $sendData['state_icon'] = ' fas fa-thumbs-up ';
        } elseif ($this->row->follow_state == 5) {
            $sendData['state_text'] = __('admin/crm_service_var.ticket_state_5');
            $sendData['state_bg'] = ' bg-danger ';
            $sendData['state_icon'] = 'fas fa-thumbs-down ';
        } elseif ($this->row->follow_state == 6) {
            $sendData['state_text'] = __('admin/crm_service_var.ticket_state_6');
            $sendData['state_bg'] = ' bg-danger ';
            $sendData['state_icon'] = 'fas fa-times-circle ';
        }

        $startTime = Carbon::parse($this->row->created_at);
        $finishTime = Carbon::parse($this->row->close_date);
        $totalDuration = $finishTime->diffInHours($startTime);

        if ($totalDuration <= 48) {
            $sendData['time_bg'] = ' bg-success ';
        } elseif ($totalDuration <= 72) {
            $sendData['time_bg'] = ' bg-warning ';
        } else {
            $sendData['time_bg'] = ' bg-danger ';
        }

        $this->sendData = $sendData;

    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm-service.leads.lead-info-closed');
    }
}
