<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PagePhotoTranslation extends Model {

    protected $table = "page_photo_translations";
    protected $fillable = ['des'];
    public $timestamps = false;

}
