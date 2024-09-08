<?php

use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use Illuminate\Support\Carbon;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('TicketDateFrom')) {
    function TicketDateFrom($date) {
        $diff_h = Carbon::parse($date)->diff(Carbon::now());
        $diff = Carbon::parse($date)->diffForHumans(Carbon::now());
        if ($diff_h->d > 0) {
            return " ( " . $diff . " )";
        } else {
            return null;
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('TicketSendWhatsapp')) {
    function TicketSendWhatsapp($row) {
        $Brek = "%0a";
        $GetMass = __('admin/crm.but_whatsapp_mass') . $Brek;
        $GetMass .= $row->customer->name;
        $Mass = str_replace(" ", "+", $GetMass);
        if ($row->customer->mobile_code == 'eg') {
            $Whatsapp_Url = 'https://api.whatsapp.com/send/?phone=2' . $row->customer->mobile . '&text=' . $Mass;
        }
        return $Whatsapp_Url;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('CardOpenState')) {
    function CardOpenState($agent,$state=null) {
        if($state){
            $open = $state ;
        }else{
            if($agent->isDesktop()){
                $open = true ;
            }else{
                $open = false ;
            }
        }
        return $open;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getNumberType')) {
    function getNumberType($agent) {
        if($agent->isDesktop()){
            $type = 'text' ;
        }else{
            $type = 'number' ;
        }
        return $type;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('checkClosedDate')) {
    function checkClosedDate($row) {
        if($row->close_date){
            $printDate = $row->close_date ." (".getDateDifference($row->created_at, $row->close_date).")";
        }else{
            $printDate = "";
        }
        return $printDate;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getDataFromDefCat')) {
    function getDataFromDefCat($data,$thisId) {
        if (is_array($data)) {
            $data = collect($data);
        }
        $name = $data->where('id', $thisId)->first()->name ?? '';
        return $name;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('returnAmount')) {
    function returnAmount($amount) {
        if($amount){
            return number_format($amount);
        }else{
            return null;
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('returnDepositInfo')) {
    function returnDepositInfo($ticket) {
        $label = " " ;
        if($ticket->paymentCash->amount_paid){
            $label .=  number_format($ticket->paymentCash->amount) ;
        }else{
            $label .=   number_format($ticket->paymentCash->amount) ;
            $label .=   "  "  . __('admin/crm_service.label_update_deposit_unpiad') ;
        }
        return $label ;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('returnCashCount')) {
    function returnCashCount($ticketid) {
        $count = CrmTicketsCash::query()->where('ticket_id',$ticketid)->count();
        return $count ;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('returnClosedForUser')) {
    function returnClosedForUser($key) {
        $h1 = "";

        if($key == 2){
          $h1 =   '<div class="alert alert-success text-right">'.__('admin/crm_service_menu.ticket_close_finished').'</div>';
        }elseif ($key == 5){
            $h1 =   '<div class="alert alert-danger text-right">'.__('admin/crm_service_menu.ticket_close_cancellation').'</div>';
        }elseif ($key == 6){
            $h1 =   '<div class="alert alert-danger text-right">'.__('admin/crm_service_menu.ticket_close_reject').'</div>';
        }

        return $h1 ;
    }
}










#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
