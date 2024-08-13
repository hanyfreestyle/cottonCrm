<?php

namespace App\AppPlugin\Data\Country;

use Illuminate\Database\Eloquent\Model;


class CountryTranslation extends Model {

  protected $table = "data_country_translations";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['name', 'capital', 'continent', 'nationality', 'currency'];


}
