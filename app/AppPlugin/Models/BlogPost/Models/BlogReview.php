<?php

namespace App\AppPlugin\Models\BlogPost\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogReview extends Model {

    protected $table = "blog_post_review";
    public $timestamps = false;

//    public function userName(): BelongsTo {
//        return $this->belongsTo(User::class, 'user_id');
//    }


}
