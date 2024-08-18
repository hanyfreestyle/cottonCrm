<?php

namespace App\AppPlugin\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqTagsTranslation extends Model {

    protected $table = "faq_tags_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
