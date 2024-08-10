<?php

namespace App\AppPlugin\Config\Branche;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model implements TranslatableContract {

  use Translatable;
  use SoftDeletes;

  public $timestamps = false;
  protected $table = "config_branches";
  public $translatedAttributes = ['title', 'address', 'work_hours', 'phone'];
  protected $fillable = ['id', 'is_active', 'postion'];
  protected $primaryKey = 'id';
  protected $translationForeignKey = 'branch_id';


}
