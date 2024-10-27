<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Model;


class ProductTranslation extends Model {

    protected $table = "pro_product_translations";
    protected $fillable = ['name'];
    public $timestamps = false;

}
