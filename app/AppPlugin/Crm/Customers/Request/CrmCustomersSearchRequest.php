<?php

namespace App\AppPlugin\Crm\Customers\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CrmCustomersSearchRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $rules = [
            'search_type' => "required",
        ];

        if($request->search_type == 1){
            $rules += [
                'name' => "required|numeric|min_digits:7",
            ];
        }else{
            $rules += [
                'name' => "required|min:4",
            ];
        }


        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
