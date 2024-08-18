<?php
namespace App\AppPlugin\Models\BlogPost\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class BlogTags extends Model implements TranslatableContract {

    use Translatable;

    public $translatedAttributes = ['name','slug'];
    protected $fillable = [];
    protected $table = "blog_tags";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'tag_id';
    public $timestamps = false;


    public function blogs(): BelongsToMany {
        return $this->belongsToMany(Blog::class,'blog_tags_pivot','tag_id', 'blog_id');
    }


}
