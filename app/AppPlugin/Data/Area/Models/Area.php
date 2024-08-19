<?php

namespace App\AppPlugin\Data\Area\Models;


use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\Country\Country;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model implements TranslatableContract {
    use Translatable;

    protected $table = "data_area";
    protected $primaryKey = 'id';
    public $translatedAttributes = ['name', 'g_title', 'g_des', 'slug'];
    protected $fillable = [];
    public $timestamps = false;

    public function scopeDef(Builder $query): Builder {
        return $query->with('translation');
    }

    public function tablename(): HasMany {
        return $this->hasMany(AreaTranslation::class)->select('id', 'city_id', 'name');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class,'city_id');
    }

}
