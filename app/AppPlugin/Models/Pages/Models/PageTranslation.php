<?php

namespace App\AppPlugin\Models\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model {

    protected $table = "page_post_lang";
    protected $fillable = ['name'];
    public $timestamps = false;

}
