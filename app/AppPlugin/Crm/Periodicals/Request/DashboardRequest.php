<?php

namespace App\AppPlugin\Crm\Periodicals\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DashboardRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $rules = [
            'periodicals_id' => "required",
            'year' => "required|numeric|between:1900,2024",
            'month' => "required|numeric|between:1,12",
            'number' => "required|numeric",
        ];
        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
