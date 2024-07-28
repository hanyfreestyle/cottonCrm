<?php

namespace App\AppPlugin\Crm\Customers\Request;

use App\AppPlugin\Crm\Customers\Rules\CrmUniqueMobileNum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CrmCustomersRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {
        $id = $this->route('id');
        $mobileCode = $request->input('countryCode_mobile');
        $mobile_2Code = $request->input('countryCode_mobile_2');
        $phoneCode = $request->input('countryCode_phone');
        $whatsappCode = $request->input('countryCode_whatsapp');


        $rules = [
            'name' => "required|min:4",
            'mobile' => ['required', "phone:mobile,$mobileCode", 'different:mobile_2', 'different:phone', new CrmUniqueMobileNum($id)],
            'mobile_2' => ['nullable', "phone:mobile,$mobile_2Code", 'different:mobile', 'different:phone', new CrmUniqueMobileNum($id)],
        ];

        if ($request->input('phoneAreaCode')) {
            $rules += [
                'phone' => ['nullable',"phone:!mobile,$phoneCode",'different:mobile','different:mobile_2', new
                CrmUniqueMobileNum($id)],
            ];
        } else {
            $rules += [
                'phone' => ['nullable','different:mobile','different:mobile_2', new CrmUniqueMobileNum($id)],
            ];
        }

        if ($request->input('addAddress')) {
            $rules += [
                'address' => "nullable|min:4",
                'floor'=> "nullable|min:1",
                'unit_num'=> "nullable",
                'post_code'=> 'nullable|regex:/^[0-9]{3,7}$/',
                'latitude'=> "nullable|numeric|required_with:latitude",
                'longitude'=> "nullable|numeric|required_with:longitude",
            ];
        }

        if ($id == '0') {
            $rules += [
                'whatsapp' => ['nullable', "phone:mobile,$whatsappCode", "unique:crm_customers"],
                'email' => "nullable|email|unique:crm_customers",
            ];
        } else {
            $rules += [
                'whatsapp' => ['nullable', "phone:mobile,$whatsappCode", "unique:crm_customers,whatsapp,$id"],
                'email' => "nullable|email|unique:crm_customers,email,$id",
            ];
        }
        return $rules;
    }

    public function messages() {
        return [
            'mobile.different' => " :attribute مكرر",
            'mobile_2.different' => " :attribute مكرر",
            'phone.different' => " :attribute مكرر",
        ];
    }


}
