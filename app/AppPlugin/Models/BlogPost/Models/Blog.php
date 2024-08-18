<?php

namespace App\AppPlugin\Models\BlogPost\Models;

use App\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model implements TranslatableContract {

    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['name', 'des', 'other', 'slug'];
    protected $fillable = ['category_id', 'photo', 'photo_thum_1', 'is_active', 'postion', 'text_view', 'url_type'];
    protected $table = "blog_post";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'blog_id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function categories(): BelongsToMany {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_pivot', 'blog_id', 'category_id');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(BlogTags::class, 'blog_tags_pivot', 'blog_id', 'tag_id');
    }

    public function more_photos(): HasMany {
        return $this->hasMany(BlogPhoto::class, 'blog_id', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scopeDefAdmin(Builder $query): Builder {
        return $query->with('translations')
            ->with('categories')
            ->withCount('more_photos');
    }


//    public function reviews(): HasMany {
//        return $this->hasMany(BlogReview::class, 'blog_id')
//            ->with('userName')
//            ->orderBy('updated_at', 'DESC');
//    }


//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function scopeDefhomequery(Builder $query): Builder {
//        return $query->where('is_active', true)
//            ->whereDate('published_at', '<=', today())
//            ->with('translation')->with('user')
//            ->orderBy('published_at', 'desc')
//            ->translatedIn();
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #
//    public function scopeDefinRandomOrder(Builder $query): Builder {
//        return $query->where('is_active', true)
//            ->whereDate('published_at', '<=', today())
//            ->with('translations')->with('user')
//            ->translatedIn();
//    }


}
