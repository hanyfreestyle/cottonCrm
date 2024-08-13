<?php

namespace App\View\Components\Admin\Web;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Illuminate\Support\Facades\File;
use App\AppPlugin\Config\SiteMap\GoogleCode;


class GoogleTags extends Component {

    public $isactive;
    public $type;
    public $option_2;

    public function __construct(
        $isactive = true,
        $type = null,
        $option_2 = null,

    ) {
        $this->isactive = $isactive;
        $this->type = $type;
        $this->option_2 = $option_2;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function render(): View|Closure|string {
        $row = array();
        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $row = self::CashGoogleCode();
        }
        return view('components.admin.web.google-tags', compact('row'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashGoogleCode($stopCash = 0) {
        if ($stopCash) {
            $CashGoogleCode = GoogleCode::query()->get()->first();
        } else {
            $CashGoogleCode = Cache::remember('CashGoogleCode', cashDay(7), function () {
                return GoogleCode::query()->get()->first();
            });
        }
        return $CashGoogleCode;
    }

}
