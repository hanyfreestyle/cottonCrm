<?php

namespace App\AppPlugin\Data\ConfigData\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ConfigDataTranslation extends Model {

    protected $table = "config_data_translations";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [];


}
