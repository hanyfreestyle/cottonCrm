<?php

namespace App\AppPlugin\Models\Pages\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagePhoto extends Model implements TranslatableContract {

    use Translatable;

    public $translatedAttributes = ['des'];
    protected $table = "page_photo";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $translationForeignKey = 'photo_id';

//    public function modelName(): BelongsTo {
//        return $this->belongsTo(Page::class, 'page_id', 'id');
//    }


}