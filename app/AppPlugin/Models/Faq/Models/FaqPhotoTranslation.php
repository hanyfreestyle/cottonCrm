<?php

namespace App\AppPlugin\Models\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqPhotoTranslation extends Model {

    public $timestamps = false;
    protected $table = "faq_photo_lang";
    protected $fillable = ['des'];

}
