<?php

namespace App\AppPlugin\Config\Meta;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class MetaTag extends Model implements TranslatableContract {

    use Translatable;

    protected $table = "config_meta_tags";
    protected $primaryKey = 'id';
    public $translatedAttributes = ['g_title', 'g_des', 'des', 'name'];
    protected $fillable = ['cat_id'];


}
