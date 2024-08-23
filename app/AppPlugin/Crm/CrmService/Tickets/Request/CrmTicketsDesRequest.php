<?php

namespace App\AppPlugin\Crm\CrmService\Tickets\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CrmTicketsDesRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $rules = [
            'search_type' => "required",
        ];

        $rules += [
            'name' => "required|numeric|min_digits:7",
        ];

        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
