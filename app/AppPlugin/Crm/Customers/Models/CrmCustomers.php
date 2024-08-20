<?php

namespace App\AppPlugin\Crm\Customers\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CrmCustomers extends Model {

    protected $table = "crm_customers";
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function scopeDef(Builder $query): Builder {
        return $query->where('id','!=',0);
    }

    public function address(): HasMany {
        return $this->hasMany(CrmCustomersAddress::class,'customer_id','id')->with('area');
    }

}
