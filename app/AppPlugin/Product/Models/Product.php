<?php

namespace App\AppPlugin\Product\Models;


use App\AppPlugin\Customers\Models\ShoppingOrderProduct;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;



class Product extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'slug', 'des', 'g_title', 'g_des', 'short_des'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active'];
    protected $table = "pro_product";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'product_id';


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     tablename
    public function tablename(): HasMany{
        return $this->hasMany(ProductTranslation::class)->select('id','product_id','name');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDef(Builder $query): Builder {
        return $query->with('translations')
            ->with('categories')
            ->where('parent_id', null)
            ->withCount('more_photos');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # categories
    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'pro_category_product');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # tags
    public function tags(): BelongsToMany {
        return $this->belongsToMany(ProductTags::class, 'pro_tags_product', 'product_id', 'tag_id');
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # attributes
    public function attributes(): BelongsToMany {
        return $this->belongsToMany(Attribute::class, 'pro_product_attribute', 'product_id', 'attribute_id')->withPivot(['id', 'values']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # more_photos
    public function more_photos(): HasMany {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CartPriceToAdd
    public function CartPriceToAdd() {
        if(intval($this->price) > 0 and intval($this->sale_price) != 0
            and intval($this->sale_price) < intval($this->price)) {
            return $this->sale_price;
        } else {
            return $this->price;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefWep(Builder $query): Builder {
        return $query->where('is_active', true)
            ->where('parent_id', null)
            ->where('is_archived', false)
            ->with('translations')
            ->translatedIn();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefWepAll(Builder $query): Builder {
        return $query->where('is_active', true)
            ->where('is_archived', false)
            ->where('parent_id', null)
            ->with('translations')
            ->with('categories')
            ->with('tags')
            ->with('brand')
            ->with('attributes')
            ->with('more_photos')
            ->withcount('more_photos')
            ->withcount('childproduct')
            ->translatedIn();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefWepLight(Builder $query): Builder {
        return $query->where('is_active', true)->translatedIn();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function mainPro() {
        return $this->belongsTo(Product::class, 'parent_id', 'id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function childproduct() {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    public function orders(): HasMany {
        return $this->hasMany(ShoppingOrderProduct::class,'product_id','id');
    }
}
