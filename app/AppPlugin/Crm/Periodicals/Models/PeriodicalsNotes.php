<?php

namespace App\AppPlugin\Crm\Periodicals\Models;


use Illuminate\Database\Eloquent\Model;


class PeriodicalsNotes extends Model {
    protected $table = "book_periodicals_notes";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;

}
