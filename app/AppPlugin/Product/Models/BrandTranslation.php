<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Model;

class BrandTranslation extends Model {
    protected $table = "pro_brand_translations";
    protected $fillable = ['name'];
    public $timestamps = false;

}
