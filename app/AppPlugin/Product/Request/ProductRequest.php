<?php

namespace App\AppPlugin\Product\Request;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $data = $this->toArray();
        $data = AdminMainController::prepareSlug($data);
        $this->merge($data);
    }

    public function rules(Request $request): array {

        $addLang = json_decode($request->add_lang);
        foreach ($addLang as $key => $lang) {
            $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
        }

        $id = $this->route('id');

        $rules = [
            'is_active' => "required",
            'is_archived' => "required",
            'featured' => "required",
            'on_stock' => "required",

            'categories' => 'required|array|min:1',
            'price' => "required|numeric|gt:0",
            'regular_price' => "nullable|numeric|gt:price",
            'sales_count' => "nullable|numeric",
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:10000',
        ];

        $rulesConfig = [
            'slug' => true,
            'des' => true,
            'seo' => true,
        ];

        $rules += AdminMainController::FormRequestSeo($id, $addLang, 'pro_product_lang', 'product_id',$rulesConfig);

        return $rules;
    }
}
