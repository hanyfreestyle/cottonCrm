<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogTagsTranslation extends Model {

    protected $table = "blog_tags_lang";
    protected $fillable = ['name'];
    public $timestamps = false;
}
