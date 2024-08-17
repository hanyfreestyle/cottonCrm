<?php


namespace App\AppPlugin\Faq\Models;

use App\AppPlugin\BlogPost\Models\BlogTags;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'des', 'other', 'slug'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active', 'postion', 'text_view', 'url_type'];
    protected $table = "faq_faqs";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'faq_id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     tablename
    public function tablename(): HasMany{
        return $this->hasMany(FaqTranslation::class)->select('id','faq_id','name');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   scopeDef
    public function scopeDef(Builder $query): Builder {
        return $query->with('translations')
//            ->with('categories')
//            ->withCount('more_photos')
            ;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # categories
    public function categories(): BelongsToMany {
        return $this->belongsToMany(FaqCategory::class,'faq_category_faq','faq_id', 'category_id');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function faqs() {
        return $this->belongsToMany(Faq::class, 'faq_category_faq', 'category_id', 'faq_id')
            ->withPivot('postion')->orderBy('postion');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # tags
    public function tags(): BelongsToMany {
        return $this->belongsToMany(FaqTags::class, 'faq_tags_post', 'post_id', 'tag_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefquery(Builder $query): Builder {
        return $query->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # more_photos
    public function more_photos(): HasMany {
        return $this->hasMany(FaqPhoto::class, 'faq_id', 'id');
    }


}
