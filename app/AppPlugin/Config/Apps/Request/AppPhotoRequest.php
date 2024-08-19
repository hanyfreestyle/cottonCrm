<?php

namespace App\AppPlugin\Config\Apps\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AppPhotoRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {

    }

    public function rules(Request $request): array {

        $rules = [
            'image' => 'required|mimes:jpeg,jpg,png,gif,webp|max:10000',
        ];

        return $rules;
    }

    public function messages() {
        return [
            'filter_id.required_with' => 'برجاء تحديد الفلتر',
        ];
    }

}
