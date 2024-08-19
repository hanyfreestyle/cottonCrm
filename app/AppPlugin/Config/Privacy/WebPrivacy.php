<?php

namespace App\AppPlugin\Config\Privacy;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class WebPrivacy extends Model implements TranslatableContract {
    use Translatable;

    public $translatedAttributes = ['h1', 'h2', 'des', 'lists'];
    protected $fillable = ['id', 'name', 'position'];
    protected $table = "config_web_privacy";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'privacy_id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefquery(Builder $query): Builder {
        return $query->with('translations');
    }

}
