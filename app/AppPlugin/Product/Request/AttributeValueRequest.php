<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AttributeValueRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        foreach (config('app.web_lang') as $key => $lang) {
            data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
        }
        $this->merge($data);
    }

    public function rules(Request $request): array {
        foreach (config('app.web_lang') as $key => $lang) {
            $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
        }

        $id = $this->route('id');
        $rules = [];
        foreach (config('app.web_lang') as $key => $lang) {
            if($id == '0') {
                $rules[$key . ".name"] = "required|unique:pro_attribute_value_lang,name";
                $rules[$key . ".slug"] = "required|unique:pro_attribute_value_lang,slug";
            } else {
                $rules[$key . ".name"] = "required|unique:pro_attribute_value_lang,name,$id,value_id,locale,$key";
                $rules[$key . ".slug"] = "required|unique:pro_attribute_value_lang,slug,$id,value_id,locale,$key";
            }
        }
        return $rules;
    }
}
