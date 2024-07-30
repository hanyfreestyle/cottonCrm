<?php

namespace App\AppPlugin\Crm\Periodicals\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BookNotesRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {
        $id = $this->route('id');

        $rules = [
            'tag_id'=> 'required|array|min:1'
        ];

        if ($id == '0') {
            $rules["name"] = "required|unique:book_periodicals_notes,name";

        } else {
            $rules["name"] = "required|unique:book_periodicals_notes,name,$id";
        }

        return $rules;
    }
}



