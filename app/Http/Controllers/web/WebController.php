<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Auth;

class WebController extends WebMainController {
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UnderConstruction() {
        $config = WebMainController::getWebConfig(0);
        if ($config->web_status == 1 or Auth::check()) {
            return redirect()->route('page_index');
        }
        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'page_index');

        return view('under');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function NoIndex() {
        return view('no_index');
    }

}
