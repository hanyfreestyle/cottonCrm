<?php

namespace App\AppPlugin\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model {

    public $timestamps = false;
    protected $table = "faq_translations";
    protected $fillable = ['name'];

}
