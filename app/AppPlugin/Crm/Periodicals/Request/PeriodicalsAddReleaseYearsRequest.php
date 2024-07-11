<?php

namespace App\AppPlugin\Crm\Periodicals\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PeriodicalsAddReleaseYearsRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $rules = [
            'year' => "required|numeric|between:1900,2024",
            'yearslist' => "required|array|min:2",
        ];


        for ($i = 1; $i <= 12; $i++) {
            $rules += [
                'notes_' . $i => "nullable|min:3",
                'repeat_' . $i => "nullable|numeric",
            ];

        }

        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
