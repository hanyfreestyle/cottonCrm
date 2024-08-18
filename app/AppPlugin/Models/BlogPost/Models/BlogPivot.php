<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogPivot extends Model {
    protected $table = "blog_category_pivot";
    public $timestamps = false;
}
