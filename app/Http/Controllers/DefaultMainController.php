<?php

namespace App\Http\Controllers;

use App\Http\Traits\DefCategoryTraits;
use App\Http\Traits\GetCashList;


use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;

class DefaultMainController extends Controller {

    use DefCategoryTraits;
    use GetCashList;

    public function __construct() {

        $this->agent = new Agent();
        View::share('agent', $this->agent);

        $this->defCategory = self::LoadCategory();


    }

}
