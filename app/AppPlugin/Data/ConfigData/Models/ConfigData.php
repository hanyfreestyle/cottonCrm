<?php

namespace App\AppPlugin\Data\ConfigData\Models;


use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ConfigData extends Model implements TranslatableContract {
    use Translatable;

    protected $table = "config_data";
    protected $primaryKey = 'id';
    public $translatedAttributes = ['name', 'g_title', 'g_des', 'slug'];
    protected $fillable = [];
    public $timestamps = false;
    protected $translationForeignKey = 'data_id';

    public function scopeDef(Builder $query): Builder {
        return $query->with('translation');
    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     tablename
//    public function tablename(): HasMany{
//        return $this->hasMany(ConfigDataTranslation::class,'data_id','id')->select('id','data_id','name');
//    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     tablename
    public function tablename(): HasMany{
        return $this->hasMany(ConfigDataTranslation::class,'data_id','id');
    }

}
