<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogTagsPivot extends Model {
    protected $table = "blog_tags_pivot";
    public $timestamps = false;
}