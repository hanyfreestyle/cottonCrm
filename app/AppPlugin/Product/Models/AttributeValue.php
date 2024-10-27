<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AttributeValue extends Model implements TranslatableContract {

    use Translatable;

    protected $table = "pro_attribute_values";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'value_id';
    public $translatedAttributes = ['name', 'slug'];
    protected $fillable = [];
    public $timestamps = false;


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeDef
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDef(Builder $query): Builder {
        return $query->with('translations');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     children

}



