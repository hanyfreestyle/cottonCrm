<?php

namespace App\AppPlugin\Pages\Models;


use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model {

    protected $table = "page_post_translations";
    protected $fillable = ['name'];
    public $timestamps = false;

}
