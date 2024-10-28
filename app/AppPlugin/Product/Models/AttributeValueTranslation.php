<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueTranslation extends Model {

    protected $table = "pro_attribute_value_lang";
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

}
