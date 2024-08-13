<?php

namespace App\AppPlugin\Data\ConfigData\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ConfigDataRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(Request $request): array {
        $addLang = config('app.web_lang');

        $id = $this->route('id');

        $rules = [
            'test' => "nullable",
        ];

        foreach ($addLang as $key => $lang) {
            if ($id == '0') {
                $rules[$key . ".name"] = "required|unique:config_data_translations,name";
            } else {
                $rules[$key . ".name"] = "required|unique:config_data_translations,name,$id,data_id,locale,$key";
            }
        }

        return $rules;
    }


}
