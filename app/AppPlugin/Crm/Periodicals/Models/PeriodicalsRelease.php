<?php

namespace App\AppPlugin\Crm\Periodicals\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodicalsRelease extends Model {

    protected $table = "book_periodicals_release";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


    public function periodicals(): BelongsTo {
        return $this->belongsTo(Periodicals::class,'periodicals_id','id');
    }

    public function printReleaseName() {
        $printName = $this->periodicals->name ." ".$this->year." ".__('admin/Periodicals.form_release_month')." "
            .$this->month." ".__('admin/Periodicals.form_release_num')." ".$this->number  ;
        return $printName ;
    }


}
