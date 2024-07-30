<?php

namespace App\AppPlugin\Crm\Periodicals\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PeriodicalsAddReleaseRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $rules = [
            'year' => "required|numeric|between:1900,2024",
            'month' => "required|numeric|between:1,12",
            'number' => "required|numeric",
            'notes' => "nullable|min:3",
            'repeat' => "nullable|numeric",

        ];
        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
