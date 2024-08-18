<?php

namespace App\AppPlugin\Pages\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class PageCategory extends Model implements TranslatableContract {

    use Translatable;
    use HasRecursiveRelationships;

    public $translatedAttributes = ['slug', 'name', 'des', 'g_title', 'g_des'];
    protected $fillable = ['updated_at'];
    protected $table = "page_category";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'category_id';
    public $timestamps = true;




//    public function scopeDef(Builder $query): Builder {
//        return $query->with('translations')->withCount('children');
//    }
//
//
//    public function scopeDefquery(Builder $query): Builder {
//        return $query->with('translations');
//    }
//
//
//    public function scopeDefWeb(Builder $query): Builder {
//        return $query->where('is_active', true)
//            ->with('translation')
//            ->with('faqs')
//            ->withCount('faqs')
//            ->orderBy('faqs_count', 'desc');
//    }
//
//    public function slugs(): HasMany {
//        return $this->hasMany(FaqCategoryTranslation::class, 'category_id', 'id');
//    }
//
//    public function getLocalizedRouteKey($locale) {
//        return $this->slugs()->where('locale', $locale)->first()->slug;
//    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_category(): HasMany {
        return $this->hasMany(PageCategory::class, 'parent_id');
    }

    public function del_page() {
        return $this->belongsToMany(Page::class, 'page_category_t_pivot', 'category_id', 'page_id')
            ->withTrashed();
    }


}
