<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Models;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmTicketsCash extends Model {
    protected $table = "crm_ticket_cash";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scopeDefUnpaid(Builder $query): Builder {
        return $query->where('amount_paid', null)
            ->where('confirm_date', null)
            ->where('pay_type', 1)
            ->wherein('amount_type', ['1','2','3'])
            ->with('ticket')
            ->with('customer')
            ->with('user');
    }


    public function ticket(): BelongsTo {
        return $this->belongsTo(CrmTickets::class, 'ticket_id', 'id')->with('des');
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(CrmCustomers::class, 'customer_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cashDes(): BelongsTo {
        return $this->belongsTo(CrmTicketsDes::class,'ticket_id','ticket_id')->where('follow_state',$this->follow_state);
    }

//
}
