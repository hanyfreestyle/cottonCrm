<?php

namespace App\AppPlugin\Pages\Models;

use App\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'des', 'other', 'slug', 'g_title', 'g_des', 'youtube_title'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active', 'position', 'text_view', 'url_type'];
    protected $table = "page_pages";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'page_id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scopeDefAdmin(Builder $query): Builder {
        return $query->with('translations')
            ->with('categories')
            ->with('user')
            ->withCount('more_photos');
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function categories(): BelongsToMany {
        return $this->belongsToMany(PageCategory::class, 'pagecategory_page', 'page_id', 'category_id');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(PageTags::class, 'page_tags_post', 'post_id', 'tag_id');
    }

    public function more_photos(): HasMany {
        return $this->hasMany(PagePhoto::class, 'page_id', 'id')->with('translation');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function pages() {
//        return $this->belongsToMany(Page::class, 'pagecategory_page', 'category_id', 'page_id')
//            ->withPivot('position')->orderBy('position');
//    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function scopeDefquery(Builder $query): Builder {
        return $query->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # more_photos


}
