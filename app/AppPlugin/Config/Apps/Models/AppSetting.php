<?php

namespace App\AppPlugin\Config\Apps\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class AppSetting extends Model implements TranslatableContract {

    use Translatable;

    protected $table = "config_app_settings";
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $translatedAttributes = ['AppName', 'whatsAppMessage'];
    protected $translationForeignKey = 'setting_id';

}
