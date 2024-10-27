<?php

namespace App\AppPlugin\Product\Models;


use Illuminate\Database\Eloquent\Model;

class ProductTagsTranslation extends Model {


    public $timestamps = false;
    protected $table = "pro_tags_translations";
    protected $fillable = ['name'];
}
