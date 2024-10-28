<?php

namespace App\AppPlugin\Product\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingPage extends Model implements TranslatableContract {
    use Translatable;

    public $translatedAttributes = ['name', 'des', 'other', 'slug', 'g_title', 'g_des', 'desup'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active', 'position', 'text_view', 'url_type'];
    protected $table = "pro_landing_page";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'page_id';

    protected $casts = [
        'product_id' => 'array',
    ];


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   scopeDef
    public function scopeDef(Builder $query): Builder {
        return $query->with('translation');
    }

    public function barnd(): BelongsTo {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }


}
