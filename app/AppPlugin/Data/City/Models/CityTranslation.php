<?php

namespace App\AppPlugin\Data\City\Models;

use Illuminate\Database\Eloquent\Model;


class CityTranslation extends Model {

  protected $table = "data_city_translations";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = [];


}
