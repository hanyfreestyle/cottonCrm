<?php

namespace App\AppPlugin\Data\Country;

use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Laravel\Prompts\select;

class Country extends Model implements TranslatableContract {

  use SoftDeletes;
  use Translatable;

  protected $table = "data_countries";
  protected $primaryKey = 'id';
  public $translatedAttributes = ['name', 'capital', 'continent', 'nationality', 'currency'];
  protected $fillable = [];
  public $timestamps = false;


  public function tablename(): HasMany {
    return $this->hasMany(CountryTranslation::class)->select('id', 'country_id', 'name');
  }

}
