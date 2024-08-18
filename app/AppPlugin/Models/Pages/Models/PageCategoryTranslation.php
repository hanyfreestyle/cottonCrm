<?php

namespace App\AppPlugin\Models\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageCategoryTranslation extends Model {

    public $timestamps = false;
    protected $table = "page_category_lang";
    protected $fillable = ['name'];

}
