<?php

namespace App\AppPlugin\Crm\Periodicals\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class PeriodicalsNotes extends Model {
    protected $table = "book_periodicals_notes";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


    public function release(): BelongsTo {
        return $this->belongsTo(PeriodicalsRelease::class,'periodicals_id','id')->with('periodicals');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(BooksTags::class, 'book_tags_notes', 'notes_id', 'tag_id');
    }

}
