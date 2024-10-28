<?php

namespace App\View\Components\Admin\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Settings extends Component {
    public $modelname;
    public $configArr;
    public $pageData;

    public $orderby;
    public $addPhoto;
    public $selectfilterid;
    public $addIcon;
    public $addMorePhoto;
    public $orderbyDef;
    public $orderbyPostion;
    public $orderbyDate;
    public $orderbyName;

    public $icon;
    public $dataTableUserName;
    public $dataTableDate;
    public $viewAsPost;


    public function __construct(
        $modelname = "",
        $configArr = array(),
        $pageData = array(),
        $orderbyDef = "1",
    ) {
        $this->modelname = $modelname;
        $this->configArr = $configArr;

        $this->pageData = $pageData;

        $this->orderby = IsArr($configArr, 'orderby', false);
        $this->orderbyDef = $orderbyDef;
        $this->orderbyPostion = IsArr($configArr, 'orderbyPostion', false);

        $this->addPhoto = IsArr($configArr, 'addPhoto', false);
        $this->addIcon = IsArr($configArr, 'addIcon', false);
        $this->addMorePhoto = IsArr($configArr, 'addMorePhoto', false);
        $this->selectfilterid = IsArr($configArr, 'selectfilterid');


        $this->orderbyDate = IsArr($configArr, 'orderbyDate', false);
        $this->orderbyName = IsArr($configArr, 'orderbyName', true);

        $this->icon = IsArr($configArr, 'icon', false);
        $this->dataTableUserName = IsArr($configArr, 'dataTableUserName', false);
        $this->dataTableDate = IsArr($configArr, 'dataTableDate', false);
        $this->viewAsPost = IsArr($configArr, 'viewAsPost', false);


        $OrderByArr = [
            "1" => ['id' => '1', 'name' => __('admin/config/settings.sort_id_desc')],
            "2" => ['id' => '2', 'name' => __('admin/config/settings.sort_id_asc')],
            "3" => ['id' => '3', 'name' => __('admin/config/settings.sort_name_desc')],
            "4" => ['id' => '4', 'name' => __('admin/config/settings.sort_name_asc')],
            "5" => ['id' => '5', 'name' => __('admin/config/settings.sort_postion')],
            "6" => ['id' => '6', 'name' => __('admin/config/settings.sort_date_asc')],
            "7" => ['id' => '7', 'name' => __('admin/config/settings.sort_date_desc')],
        ];


        if ($this->orderbyName == false) {
            unset($OrderByArr[3]);
            unset($OrderByArr[4]);
        }

        if ($this->orderbyPostion == false) {
            unset($OrderByArr[5]);
        }
        if ($this->orderbyDate == false) {
            unset($OrderByArr[6]);
            unset($OrderByArr[7]);
        }


        \Illuminate\Support\Facades\View::share('OrderByArr', $OrderByArr);
    }

    public function render(): View|Closure|string {
        return view('components.admin.main.settings');
    }
}
