<?php

namespace App\AppPlugin\Faq\Models;


use Illuminate\Database\Eloquent\Model;

class FaqCategoryTranslation extends Model {


    public $timestamps = false;
    protected $table = "faq_category_translations";
    protected $fillable = ['name'];
}
