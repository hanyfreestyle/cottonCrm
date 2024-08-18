<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageTagsTranslation extends Model {

    protected $table = "page_tags_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
