<?php

namespace App\AppPlugin\Config\Apps\Request;

use Illuminate\Foundation\Http\FormRequest;

class AppMenuRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {
        $rules = [

        ];

        foreach (config('app.web_lang') as $key => $lang) {
            $rules[$key . ".label"] = 'required';
            $rules[$key . ".icon"] = 'required|integer';
            $rules[$key . ".url"] = 'required|url';
        }

        return $rules;
    }
}
