<?php

namespace App\AppPlugin\Models\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageTagsTranslation extends Model {

    protected $table = "page_tags_lang";
    protected $fillable = ['name'];
    public $timestamps = false;
}
