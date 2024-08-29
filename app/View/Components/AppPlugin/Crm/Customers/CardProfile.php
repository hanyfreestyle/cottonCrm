<?php

namespace App\View\Components\AppPlugin\Crm\Customers;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardProfile extends Component {

    public $row;
    public $allData;
    public $config;
    public $softData;
    public $defLang;
    public $addTitle;
    public $viewList;
    public $customerId;

    public function __construct(
        $row = array(),
        $allData = false,
        $config = array(),
        $softData = false,
        $defLang = null,
        $addTitle = false,
        $viewList = 'icon',
        $customerId = null,

    ) {

        $this->customerId = $customerId;

        if($this->customerId){
            $this->row = CrmCustomers::query()->where('id',$this->customerId)->with('address')->first();
        }else{
            $this->row = $row;
        }

        $this->viewList = $viewList;
        $this->allData = $allData;
        $this->config = $config;
        $this->softData = $softData;
        $this->addTitle = $addTitle;

        if($defLang == null){
            $this->defLang = 'admin/crm/customers.';
        }else{
            $this->defLang = $defLang;
        }



    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.crm.customers.card-profile');
    }
}
