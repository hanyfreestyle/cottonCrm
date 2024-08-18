<?php


namespace App\AppPlugin\Faq\Models;


use App\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'des', 'other', 'slug'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active', 'position', 'text_view', 'url_type'];
    protected $table = "faq_post";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'faq_id';


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function categories(): BelongsToMany {
        return $this->belongsToMany(FaqCategory::class, 'faq_category_t_pivot', 'faq_id', 'category_id');
    }

    public function faqs() {
        return $this->belongsToMany(Faq::class, 'faq_category_t_pivot', 'category_id', 'faq_id')
            ->withPivot('position')->orderBy('position');
    }


    public function tags(): BelongsToMany {
        return $this->belongsToMany(FaqTags::class, 'faq_tags_t_pivot', 'faq_id', 'tag_id');
    }

    public function more_photos(): HasMany {
        return $this->hasMany(FaqPhoto::class, 'faq_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   scopeDef
    public function scopeDefAdmin(Builder $query): Builder {
        return $query->with('translations')
            ->with('categories')
            ->withCount('more_photos');
    }

}
