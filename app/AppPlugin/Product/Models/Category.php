<?php

namespace App\AppPlugin\Product\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model implements TranslatableContract {

    use Translatable;
    use HasRecursiveRelationships;


    protected $table = "pro_category";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'category_id';
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
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     scopeRoot
    public function scopeRoot(Builder $query): Builder {
        return $query->whereNull('parent_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function recursive_product_shop() {
        return $this->belongsToManyOfDescendantsAndSelf(Product::class, 'pro_category_pivot')
            ->with('translation')
            ->with('categories')
            ->where('is_active', true)
//            ->where('is_archived', false);
        ;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  products
    public function products() {
        return $this->belongsToMany(Product::class, 'pro_category_pivot', 'category_id', 'product_id')
            ->where('is_active', true)
//            ->where('is_archived', false)
            ->with('translation');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  productsHome
    public function products_home() {
        return $this->belongsToMany(Product::class, 'pro_category_pivot', 'category_id', 'product_id')
            ->where('is_active', true)
//            ->where('is_archived', false)
            ->where('parent_id', null)
            ->translatedIn();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  products
    public function products_count() {
        return $this->belongsToMany(Product::class, 'pro_category_pivot', 'category_id', 'product_id')
            ->where('is_active', true)
//            ->where('is_archived', false)
            ->with('translation');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  products
    public function products_count_filter() {
        return $this->belongsToMany(Product::class, 'pro_category_pivot', 'category_id', 'product_id')
            ->where('is_active', true)
//            ->where('is_archived', false)
            ->with('translation');

    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_category(): HasMany {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function del_product() {
        return $this->belongsToMany(Product::class, 'pro_category_pivot', 'category_id', 'product_id')->withTrashed();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CashCategoriesList
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function scopeCashCategoriesList(Builder $query): array|Collection {
        return $query->select('id')->with(['translations' => function ($query) {
            $query->select('category_id', 'locale', 'name');
        }])->get();
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     childrenWeb
    public function childrenWeb(): hasMany {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->where('is_active',true)
            ->withCount('products')
            ->translatedIn()
            ->with('translations')
            ->orderby('products_count','desc');
    }

    public function scopeDefWep(Builder $query): Builder {
        return $query->where('is_active',true)
            ->with('translations')
            ->withCount('childrenWeb')
            ->with('childrenWeb')
            ->withCount('products')
            ->translatedIn();
    }
}

