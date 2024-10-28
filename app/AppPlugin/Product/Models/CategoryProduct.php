<?php

namespace App\AppPlugin\Product\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryProduct extends Model {

    protected $table = "pro_category_pivot";
    public $timestamps = false;
    protected $fillable = ['category_id', 'product_id'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #      category
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #      product
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

}
