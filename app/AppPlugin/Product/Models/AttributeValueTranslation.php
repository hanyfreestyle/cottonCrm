<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueTranslation extends Model {

    protected $table = "pro_attribute_value_translations";
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

}
