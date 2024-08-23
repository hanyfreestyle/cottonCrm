<?php

namespace App\View\Components\Admin\Form;

use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;


class SelectData extends Component {
    public $row;
    public $col;
    public $colMobile;
    public $labelview;
    public $label;
    public $req;
    public $name;
    public $id;
    public $sendArr;
    public $sendid;
    public $sendvalue;
    public $printName;
    public $catId;
    public $filterForm;
    public $active;
    public $l;


    public function __construct(
        $row = array(),
        $col = null,
        $colMobile = null,
        $labelview = true,
        $l = true,
        $label = "Input Name",
        $req = true,
        $name = null,
        $id = null,
        $sendid = 'id',
        $sendvalue = null,
        $printName = 'name',
        $catId = null,
        $filterForm = false,
        $active = true,

    ) {
        $this->active = $active;
        $this->row = $row;
        $this->col = getCol($col);
        $this->colMobile = getColMobile($colMobile);
        $this->labelview = $labelview;
        $this->l = $l;
        $this->label = $label;
        $this->req = $req;
        $this->name = $name;
        if ($id == null) {
            $this->id = $name;
        } else {
            $this->id = $id;
        }

        $configData = self::CashConfigDataList();
        $this->catId = $catId;
        $this->sendArr = $configData->where('cat_id', $this->catId);
        $this->sendid = $sendid;
        $this->printName = $printName;


        if($filterForm){
            $this->sendvalue = $sendvalue;
        }else{
            if ($sendvalue != null) {
                $this->sendvalue = $sendvalue;
            } else {
                $rowName = $this->name;
                $this->sendvalue = old($printName, $row->$rowName ?? '');
            }
        }

    }


    public function render(): View|Closure|string {
        return view('components.admin.form.select-data');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashConfigDataList($stopCash = 0) {
        if ($stopCash) {
            $CashConfigDataList = ConfigData::query()->orderByTranslation('name', 'ASC')->get();
        } else {
            $CashConfigDataList = Cache::remember('CashConfigDataList', cashDay(7), function () {
                return ConfigData::query()->orderByTranslation('name', 'ASC')->get();
            });
        }
        return $CashConfigDataList;
    }

}
