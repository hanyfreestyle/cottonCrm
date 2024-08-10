<?php

namespace App\AppPlugin\Config\Apps\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppMenu extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    protected $table = "config_app_menus";
    public $translatedAttributes = ['url', 'label', 'icon', 'title'];
    protected $fillable = ['id', 'type'];
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'menu_id';
    public $timestamps = false;
}
