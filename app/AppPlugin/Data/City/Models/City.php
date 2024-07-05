<?php

namespace App\AppPlugin\Data\City\Models;

use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Data\Country\Country;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model implements TranslatableContract {
    use Translatable;

    protected $table = "data_city";
    protected $primaryKey = 'id';
    public $translatedAttributes = ['name', 'g_title', 'g_des', 'slug'];
    protected $fillable = [];
    public $timestamps = false;

    public function scopeDef(Builder $query): Builder {
        return $query->with('translation');
    }

    public function tablename(): HasMany {
        return $this->hasMany(CityTranslation::class)->select('id', 'city_id', 'name');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class,'country_id');
    }

}
