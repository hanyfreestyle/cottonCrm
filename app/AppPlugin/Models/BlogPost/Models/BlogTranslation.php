<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model {

    public $timestamps = false;
    protected $table = "blog_post_lang";
    protected $fillable = ['name'];

}
