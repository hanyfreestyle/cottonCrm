<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Models;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmTicketsCash extends Model {
    protected $table = "crm_ticket_cash";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


    public function ticket(): BelongsTo {
        return $this->belongsTo(CrmTickets::class, 'ticket_id','id');
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(CrmCustomers::class, 'customer_id','id');
    }

}
