<?php

namespace App\View\Components\Admin\Report;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ChartWeek extends Component {

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

        $allDayCount = 0;
        $dayList = "";
        $dayCountList = "";
        for ($i = 0; $i <= 7; $i++) {
            $day = Carbon::now()->subDay(7)->addDay($i);
            $count = CrmCustomers::query()->whereDate('created_at', $day)->count();
            $allDayCount = $allDayCount + $count;
            if ($i == 7) {
                $dayList .= "'" . date("dS", strtotime($day)) . "'";
                $dayCountList .= $count;
            } else {
                $dayList .= "'" . date("dS", strtotime($day)) . "'" . ",";
                $dayCountList .= $count . ",";
            }
        }
        return view('components.admin.report.chart-week')->with([
            'dayList' => $dayList,
            'dayCountList' => $dayCountList,
            'allDayCount' => $allDayCount,
        ]);


    }
}
