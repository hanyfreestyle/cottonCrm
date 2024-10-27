<?php

namespace App\AppPlugin\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateVariantsRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {

    }

    public function rules(Request $request): array {
        $rules = [
            'product_variants.*.price' => "required|numeric|gt:0",
            'product_variants.*.regular_price' => "nullable|numeric|gt:product_variants.*.price",
        ];
        return $rules;
    }

    public function messages() {
        return [
            'product_variants.*.price.gt' => __('admin/proProduct.variant_err_add_price_0'),
            'product_variants.*.price.required' => __('admin/proProduct.variant_err_add_price'),
            'product_variants.*.price.numeric' => __('admin/proProduct.variant_err_numeric'),
            'product_variants.*.regular_price.numeric' => __('admin/proProduct.variant_err_regular_numeric'),
            'product_variants.*.regular_price.gt' => __('admin/proProduct.variant_err_gt'),
        ];

    }

}
