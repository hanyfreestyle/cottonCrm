<?php

namespace App\AppPlugin\Models\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PagePhotoTranslation extends Model {

    protected $table = "page_photo_lang";
    protected $fillable = ['des'];
    public $timestamps = false;

}
