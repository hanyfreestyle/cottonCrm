<?php

namespace App\AppPlugin\Data\Area\Models;

use Illuminate\Database\Eloquent\Model;


class AreaTranslation extends Model {

    protected $table = "data_area_translations";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [];


}
