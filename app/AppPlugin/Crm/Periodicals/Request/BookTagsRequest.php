<?php

namespace App\AppPlugin\Crm\Periodicals\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookTagsRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {
        $id = $this->route('id');

        $rules = [];
        foreach (config('app.web_lang') as $key => $lang) {
            if ($id == '0') {
                $rules["name"] = "required|unique:book_tags,name";

            } else {
                $rules["name"] = "required|unique:book_tags,name,$id";
            }
        }
        return $rules;
    }
}



