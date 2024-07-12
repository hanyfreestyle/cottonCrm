<?php

namespace App\AppPlugin\Crm\Periodicals\Models;

use Illuminate\Database\Eloquent\Model;

class BooksTags extends Model {

    protected $table = "book_tags";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


}
