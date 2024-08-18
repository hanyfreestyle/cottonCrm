<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogPhotoTranslation extends Model {

    protected $table = "blog_photo_lang";
    protected $fillable = ['des'];
    public $timestamps = false;
}
