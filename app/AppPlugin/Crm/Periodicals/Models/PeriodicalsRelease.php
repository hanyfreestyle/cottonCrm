<?php

namespace App\AppPlugin\Crm\Periodicals\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodicalsRelease extends Model {

    protected $table = "book_periodicals_release";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;

}
