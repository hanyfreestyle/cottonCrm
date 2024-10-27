<?php

namespace App\AppPlugin\Product\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductAttribute extends Model {

    protected $table = "pro_product_attribute";
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function attributeName(): BelongsTo {
        return $this->belongsTo(Attribute::class,"attribute_id","id");
    }

}



