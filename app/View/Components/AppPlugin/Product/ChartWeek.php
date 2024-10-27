<?php

namespace App\View\Components\AppPlugin\Product;

use App\AppPlugin\Orders\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ChartWeek extends Component {


    public function __construct() {

    }

    public function render(): View|Closure|string {
        $allDayCount = 0;
        $dayList = "";
        $dayCountList = "";
        for ($i = 0; $i <= 7; $i++) {
            $day = Carbon::now()->subDay(7)->addDay($i);
            $count = Order::query()->whereDate('created_at', $day)->count();
            $allDayCount = $allDayCount + $count;
            if ($i == 7) {
                $dayList .= "'" . date("dS", strtotime($day)) . "'";
                $dayCountList .= $count;
            } else {
                $dayList .= "'" . date("dS", strtotime($day)) . "'" . ",";
                $dayCountList .= $count . ",";
            }
        }
        return view('components.app-plugin.product.chart-week')->with([
            'dayList' => $dayList,
            'dayCountList' => $dayCountList,
            'allDayCount' => $allDayCount,
        ]);
    }
}
