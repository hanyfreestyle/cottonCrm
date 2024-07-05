<?php

namespace App\AppPlugin\Crm\Customers\Models;

use Illuminate\Database\Eloquent\Model;

class CrmCustomersAddress extends Model {
    protected $table = "crm_customers_address";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;

}
