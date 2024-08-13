<?php

namespace App\AppPlugin\Config\Apps\Models;


use Illuminate\Database\Eloquent\Model;

class AppMenuTranslation extends Model {
    public $timestamps = false;
    protected $table = "config_app_menu_translations";
    protected $fillable = ['url', 'label', 'icon', 'title'];

}
