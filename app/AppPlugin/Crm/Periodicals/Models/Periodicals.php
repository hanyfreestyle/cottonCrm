<?php

namespace App\AppPlugin\Crm\Periodicals\Models;


use App\AppPlugin\Data\Country\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Periodicals extends Model {

    protected $table = "book_periodicals";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


    public function country(): BelongsTo {
        return $this->belongsTo(Country::class,'country_id','id')->with('hany');
    }


    public function release(): HasMany {
        return $this->hasMany(PeriodicalsRelease::class,'periodicals_id','id');
    }

}
