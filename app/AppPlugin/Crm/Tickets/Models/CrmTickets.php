<?php

namespace App\AppPlugin\Crm\Tickets\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;



class CrmTickets extends Model {

    protected $table = "crm_ticket";
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function scopeDef(Builder $query): Builder {
        return $query->where('id','!=',0);
    }

}
