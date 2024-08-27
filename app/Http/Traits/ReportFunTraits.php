<?php

namespace App\Http\Traits;

use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\Models\User;
use Illuminate\Support\Carbon;

trait ReportFunTraits {
    use DefCategoryTraits;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ChartDataFromUsers($AllData, $selectDataId, $limit = 15) {
        $selectDataIdKey = array_keys($selectDataId);
        $getSoursData = User::query()->whereIn('id', $selectDataIdKey)->get();
        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ChartDataFromModel($AllData, $Model, $selectDataId, $limit = 15) {

        $selectDataIdKey = array_keys($selectDataId);

        $getSoursData = $Model::query()->where('is_active', true)
            ->with('translation')
            ->whereIn('id', $selectDataIdKey)
            ->get();

        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromGroup($AllData, $selectDataId, $addName = null, $limit = 20) {
        $sendArr = self::LoopForGetDataSoft($AllData, $selectDataId, $addName, $limit);
        return $sendArr;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function LoopForGetDataSoft($AllData, $selectDataId, $addName, $limit) {
        $countAllData = $AllData;
        $sendArr = [];
        $countData = 0;
        $other_count = 0;
        $start = 0;

        unset($selectDataId['']);

        foreach ($selectDataId as $key => $value) {
            $persent = round((count($value) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . count($value) . ") " . $addName . " " . $key . " " . $persent,
                'count' => count($value)
            ];
            $countData = $countData + count($value);
            array_push($sendArr, $arr);
        }

        $sendArr = array_sort($sendArr, 'count', SORT_DESC);

        if (count($sendArr) > $limit) {
            foreach ($sendArr as $key => $value) {
                if ($start >= $limit) {
                    unset($sendArr[$key]);
                    $other_count = $other_count + $value['count'];
                }
                $start = $start + 1;
            }
        }

        if ($other_count > 0) {
            $persent = round(($other_count / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $other_count . ") " . __('admin/def.report_other') . " " . $persent,
                'count' => $other_count,
                'setColor' => "#FF6600"
            ];
            array_push($sendArr, $arr);
        }


        if ($countData < $AllData) {

            $persent = round((($AllData - $countData) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $AllData - $countData . ") " . __('admin/def.report_undefined') . " " . $persent,
                'count' => $AllData - $countData,
                'setColor' => "#FF0000"
            ];
            array_push($sendArr, $arr);
        }


        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromDataConfig($AllData, $CatId, $selectDataId, $limit = 15) {
        $selectDataIdKey = array_keys($selectDataId);

        $getSoursData = ConfigData::query()
            ->where('cat_id', $CatId)
            ->whereIn('id', $selectDataIdKey)
            ->with('translation')
            ->get();

        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ChartDataFromDefCategory
    public function ChartDataFromDefCategory($AllData, $CatId, $selectDataId, $limit = 15) {
        $selectDataIdKey = array_keys($selectDataId);
        $getLoadCategory = self::LoadCategory();
        $getSoursData = issetArr($getLoadCategory, $CatId, array());
        $getSoursData = collect($getSoursData);
        $sendArr = self::LoopForGetData($AllData, $getSoursData, $selectDataId, $limit);
        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function LoopForGetData($AllData, $getSoursData, $selectDataId, $limit) {
        $countAllData = $AllData;
        $sendArr = [];
        $countData = 0;
        $other_count = 0;
        $start = 0;

        unset($selectDataId['']);

        foreach ($selectDataId as $key => $value) {

            $name = $getSoursData->where('id', $key)->first()->name ?? '';

            $persent = round((count($value) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . count($value) . ") " . $name . " " . $persent,
                'count' => count($value)
            ];

            $countData = $countData + count($value);
            array_push($sendArr, $arr);
        }

        $sendArr = array_sort($sendArr, 'count', SORT_DESC);

        if (count($sendArr) > $limit) {
            foreach ($sendArr as $key => $value) {
                if ($start >= $limit) {
                    unset($sendArr[$key]);
                    $other_count = $other_count + $value['count'];
                }
                $start = $start + 1;
            }
        }

        if ($other_count > 0) {
            $persent = round(($other_count / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $other_count . ") " . __('admin/def.report_other') . " " . $persent,
                'count' => $other_count,
                'setColor' => "#FF6600"
            ];
            array_push($sendArr, $arr);
        }


        if ($countData < $AllData) {

            $persent = round((($AllData - $countData) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $AllData - $countData . ") " . __('admin/def.report_undefined') . " " . $persent,
                'count' => $AllData - $countData,
                'setColor' => "#FF0000"
            ];
            array_push($sendArr, $arr);
        }


        return $sendArr;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getChartWeek($Query,$filterFiled='created_at') {
        $allDayCount = 0;
        $dayList = "";
        $dayCountList = "";
        for ($i = 0; $i <= 7; $i++) {
            $queryClone = clone $Query;
            $day = Carbon::now()->subDay(7)->addDay($i);
            $count = $queryClone->whereDate($filterFiled, $day)->count();
            $allDayCount += $count;
            if ($i == 7) {
                $dayList .= "'" . date("dS", strtotime($day)) . "'";
                $dayCountList .= $count;
            } else {
                $dayList .= "'" . date("dS", strtotime($day)) . "'" . ",";
                $dayCountList .= $count . ",";
            }
        }
        return [
            'dayList' => $dayList,
            'dayCountList' => $dayCountList,
            'allDayCount' => $allDayCount,
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getChartMonth($Query,$filterFiled='created_at') {
        $data = array();
        $allCount = 0;
        $monthList = "";
        $monthCountList = "";

        for ($i = 11; $i >= 0; $i--) {
            $queryClone = clone $Query;

            $month = Carbon::today()->startOfMonth()->subMonth($i);
            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');

            $count = $queryClone->whereMonth($filterFiled, $month)->whereYear($filterFiled, $year)->count();

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

        return [
            'monthList' => $monthList,
            'monthCountList' => $monthCountList,
            'allCount' => $allCount,
        ];
    }

}
