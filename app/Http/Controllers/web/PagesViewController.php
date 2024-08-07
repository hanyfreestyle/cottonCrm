<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Auth;


class PagesViewController extends WebMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {

        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';
        $pageView['page'] = 'page_index';

        return view('web.index')->with([
            'pageView' => $pageView,
        ]);
    }

}
