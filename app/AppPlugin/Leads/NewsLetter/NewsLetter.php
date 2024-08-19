<?php

namespace App\AppPlugin\Leads\NewsLetter;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class NewsLetter extends Model {

  protected $table = "leads_news_letters";
  protected $fillable = ['email','created_at'];
  protected $primaryKey = 'id';

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
  public function getFormatteDate() {
    return Carbon::parse($this->created_at)->locale(app()->getLocale())->translatedFormat('jS M Y');
  }
}
