<?php

namespace App\AppPlugin\Product\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Collection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Brand extends Model implements TranslatableContract {

    use Translatable;
    use HasRecursiveRelationships;


    protected $table = "pro_brands";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'brand_id';
    public $translatedAttributes = ['name', 'slug', 'des', 'g_title', 'g_des'];
    protected $fillable = [];


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeDef
    public function scopeDef(Builder $query): Builder {
        return $query->with('translations')->withCount('children');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     children
    public function children(): hasMany {
        return $this->hasMany(Brand::class, 'parent_id', 'id')->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeRoot
    public function scopeRoot(Builder $query): Builder {
        return $query->whereNull('parent_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_category(): HasMany {
        return $this->hasMany(Brand::class, 'parent_id');
    }

    public function del_product() {
        return $this->hasMany(Product::class, 'brand_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CashBrandList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    public function scopeCashBrandList(Builder $query): array|Collection {
        return $query->select('id')->with(['translations' => function ($query) {
            $query->select('brand_id', 'locale', 'name');
        }])->get();
    }


    public function teans_ar() {
        return $this->hasOne(BrandTranslation::class, 'brand_id', 'id')->where('locale', 'ar');
    }


    public function scopeDefWep(Builder $query): Builder {
        return $query->where('is_active', true)
            ->with('translations')
            ->withcount('products')
            ->translatedIn();
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class,'brand_id');
    }


}



