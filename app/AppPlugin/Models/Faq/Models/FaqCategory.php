<?php

namespace App\AppPlugin\Models\Faq\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class FaqCategory extends Model implements TranslatableContract  {

    use Translatable;
    use HasRecursiveRelationships;

    public $translatedAttributes = ['slug', 'name', 'des', 'g_title', 'g_des'];
    protected $fillable = ['updated_at'];
    protected $table = "faq_category";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'category_id';
    public $timestamps = true;

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     scopeDef
//    public function scopeDef(Builder $query): Builder {
//        return $query->with('translations')->withCount('children');
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function faqs() {
//        return $this->belongsToMany(Faq::class, 'faq_category_faq', 'category_id', 'faq_id')->with('more_photos')
//            ->withPivot('position')->orderBy('position');
//    }
//
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function scopeDefquery(Builder $query): Builder {
//        return $query->with('translations');
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//
//    public function scopeDefWeb(Builder $query): Builder {
//        return $query->where('is_active', true)
//            ->with('translation')
//            ->with('faqs')
//            ->withCount('faqs')
//            ->orderBy('faqs_count', 'desc');
//    }
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function slugs(): HasMany {
//        return $this->hasMany(FaqCategoryTranslation::class, 'category_id', 'id');
//    }
//
//
//
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function getLocalizedRouteKey($locale) {
//        return $this->slugs()->where('locale', $locale)->first()->slug;
//    }
//
//
//

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  Delete Counts
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function del_category(): HasMany {
        return $this->hasMany(FaqCategory::class, 'parent_id');
    }

    public function del_faq() {
        return $this->belongsToMany(Faq::class, 'faq_category_pivot', 'category_id', 'faq_id')->withTrashed();
    }


}