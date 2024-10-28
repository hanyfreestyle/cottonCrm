<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model {

    protected $table = "pro_attribute_lang";
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

}
