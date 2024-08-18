<?php

namespace App\AppPlugin\Models\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqTagsTranslation extends Model {

    protected $table = "faq_tags_lang";
    protected $fillable = ['name'];
    public $timestamps = false;
}
