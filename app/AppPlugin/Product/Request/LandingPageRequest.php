<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LandingPageRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        $addLang = json_decode($data['add_lang']);
        foreach ($addLang as $key => $lang) {
            data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
        }
        $this->merge($data);
    }

    public function rules(Request $request): array {
        $addLang = json_decode($request->add_lang);

        foreach ($addLang as $key => $lang) {
            $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
        }

        $id = $this->route('id');

        $rules = [
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000',
            'product_id'=> 'required|array|min:4',
            'is_soft'=> 'required'
        ];


        $rulesConfig = [
            'slug' => true,
            'des' => false,
            'seo' => false,
        ];

        $rules += AdminMainController::FormRequestSeo($id, $addLang, "pro_landing_page_translations", 'page_id',
            $rulesConfig);

        return $rules;
    }
}
