<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CrmTicketsRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {



        $rules = [

        ];

        $rules += [

        ];

        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
