<?php
namespace App\AppPlugin\Product\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class ProductTags extends Model implements TranslatableContract {

    use Translatable;

    public $translatedAttributes = ['name','slug'];
    protected $fillable = [];
    protected $table = "pro_tags";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'tag_id';
    public $timestamps = false;

    public function scopeDef(Builder $query): Builder {
        return $query->with('translations');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # products
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class,'pro_tags_pivot','tag_id', 'product_id');
    }


}
