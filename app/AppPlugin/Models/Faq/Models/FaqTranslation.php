<?php

namespace App\AppPlugin\Models\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model {

    public $timestamps = false;
    protected $table = "faq_post_lang";
    protected $fillable = ['name'];

}
