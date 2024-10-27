<?php

namespace App\AppPlugin\Product\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPhoto extends Model {

    protected $table = "pro_product_photos";
    protected $fillable = ['name'];
    public $timestamps = false;

    public function productName(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
