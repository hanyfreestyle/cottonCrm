<?php

namespace App\AppPlugin\Models\BlogPost\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class BlogCategory extends Model implements TranslatableContract {

    use Translatable;
    use HasRecursiveRelationships;

    public $translatedAttributes = ['slug', 'name', 'des', 'g_title', 'g_des'];
    protected $fillable = ['updated_at'];
    protected $table = "blog_category";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'category_id';
    public $timestamps = true;


    public function del_category(): HasMany {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    public function del_blog() {
        return $this->belongsToMany(Blog::class, 'blog_category_pivot', 'category_id', 'blog_id')->withTrashed();
    }


}

