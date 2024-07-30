<?php

namespace App\AppPlugin\Crm\Periodicals\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BooksTags extends Model {

    protected $table = "book_tags";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;

    public function notes(): BelongsToMany {
        return $this->belongsToMany(PeriodicalsNotes::class, 'book_tags_notes', 'tag_id', 'notes_id');
    }
}
