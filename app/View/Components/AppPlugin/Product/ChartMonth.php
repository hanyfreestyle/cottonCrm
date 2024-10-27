<?php

namespace App\View\Components\AppPlugin\Product;

use App\AppPlugin\Orders\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ChartMonth extends Component {


    public function __construct() {

    }

    public function render(): View|Closure|string {
        $data = array();
        $allCount = 0;

        $monthList = "";
        $monthCountList = "";


        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');

            $count = Order::query()->whereMonth('created_at', $month)->count();
            $allCount = $allCount + $count;

            if ($i == 0) {
                $monthList .= "'" . $month->shortMonthName . "'";
                $monthCountList .= $count;
            } else {
                $monthList .= "'" . $month->shortMonthName . "'" . ",";
                $monthCountList .= $count . ",";
            }


            array_push($data, array(
                'month' => $month->shortMonthName,
                'year' => $year,
                'count' => $count
            ));
        }
        return view('components.app-plugin.product.chart-month')->with([
            'monthList' => $monthList,
            'monthCountList' => $monthCountList,
            'allCount' => $allCount,
        ]);
    }
}
