<?php

namespace App\AppPlugin\Config\Branche;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;


class Branch extends Model implements TranslatableContract {
    use Translatable;

    public $timestamps = false;
    protected $table = "config_branch";
    public $translatedAttributes = ['title', 'address', 'work_hours', 'phone'];
    protected $fillable = ['id', 'is_active', 'position'];
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'branch_id';

}
