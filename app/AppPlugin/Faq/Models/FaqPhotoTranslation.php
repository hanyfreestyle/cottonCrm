<?php

namespace App\AppPlugin\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqPhotoTranslation extends Model {


    public $timestamps = false;
    protected $table = "faq_photo_translations";
    protected $fillable = ['des'];
}
