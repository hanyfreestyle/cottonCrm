<?php

namespace App\AppPlugin\Crm\Periodicals\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PeriodicalsRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {
        $id = $this->route('id');
        $rules = [
            'name' => "required|min:3",

        ];
        return $rules;
    }

    public function messages() {
        return [

        ];
    }


}
