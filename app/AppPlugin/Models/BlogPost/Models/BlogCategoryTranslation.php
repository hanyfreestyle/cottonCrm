<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use Illuminate\Database\Eloquent\Model;

class BlogCategoryTranslation extends Model {
    public $timestamps = false;
    protected $table = "blog_category_lang";
    protected $fillable = ['name'];
}
