<?php

namespace App\AppPlugin\Crm\Customers\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CrmUniqueMobileNum implements ValidationRule {

    protected $id;

    public function __construct($id) {
        $this->id = $id;

    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void {


        if ($attribute == 'mobile') {

            $count = DB::table('crm_customers')
                ->where('id', "!=", $this->id)
                ->Where('mobile', $value)
                ->orWhere('mobile_2', $value)
                ->orWhere('phone', $value)
//                ->orWhere('whatsapp', $value)
                ->count();

//            dd($count);

        }elseif ($attribute == 'mobile_2'){
            $count = DB::table('crm_customers')
                ->where('id', "!=", $this->id)
                ->Where('mobile_2', $value)
                ->orWhere('mobile', $value)
                ->orWhere('phone', $value)
//                ->orWhere('whatsapp', $value)
                ->count();
        }elseif ($attribute == 'phone'){
            $count = DB::table('crm_customers')
                ->where('id', "!=", $this->id)
                ->Where('phone', $value)
                ->orWhere('mobile', $value)
                ->orWhere('mobile_2', $value)
//                ->orWhere('whatsapp', $value)
                ->count();
        }



        if ($count != 0) {
            $url = route('admin.CrmCustomer.repeat', $value);
            $fail(' :attribute ' . __('admin/crm/customers.err_repeat_num') . ' <a target="_blank" href="' . $url . '">' . __('admin/crm/customers.err_repeat_search') . '</a>');
        }


    }
}
