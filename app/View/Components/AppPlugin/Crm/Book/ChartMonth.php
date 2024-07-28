<?php

namespace App\View\Components\AppPlugin\Crm\Book;

use App\AppPlugin\Crm\Periodicals\Models\PeriodicalsNotes;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ChartMonth extends Component {

    public $row;
    public $isactive;
    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $isactive = true,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        $data = array();
        $allCount = 0;

        $monthList = "";
        $monthCountList = "";


        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');

            $count = PeriodicalsNotes::query()->whereMonth('created_at', $month)->count();
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

//        dd($monthList);

        return view('components.app-plugin.crm.book.chart-month')->with([
            'monthList' => $monthList,
            'monthCountList' => $monthCountList,
            'allCount' => $allCount,
        ]);
    }
}
