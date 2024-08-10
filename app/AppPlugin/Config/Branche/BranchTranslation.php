<?php

namespace App\AppPlugin\Config\Branche;


use Illuminate\Database\Eloquent\Model;

class BranchTranslation extends Model {


  public $timestamps = false;
  protected $table = "config_branch_translations";
  protected $fillable = ['title', 'address', 'phone', 'whatsapp', 'work_hours', 'lat', 'long'];

}
