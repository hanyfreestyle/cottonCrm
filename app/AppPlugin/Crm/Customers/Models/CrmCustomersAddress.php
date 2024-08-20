<?php

namespace App\AppPlugin\Crm\Customers\Models;

use App\AppPlugin\Data\Area\Models\Area;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmCustomersAddress extends Model {
    protected $table = "crm_customers_address";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;

    public function area(): BelongsTo {
        return $this->belongsTo(Area::class,'area_id','id');
    }

}
