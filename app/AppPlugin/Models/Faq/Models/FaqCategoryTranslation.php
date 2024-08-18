<?php

namespace App\AppPlugin\Models\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model {

    public $timestamps = false;
    protected $table = "faq_category_lang";
    protected $fillable = ['name'];
}
