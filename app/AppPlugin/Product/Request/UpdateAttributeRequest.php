<?php

namespace App\AppPlugin\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAttributeRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {

        $rules = [
            'attributes_values' => 'required|array|min:1',
        ];

        foreach ($request->ids as $id) {
            $rules += [
                'attributes_values.'.$id => 'required|array|min:2',
            ];
        }


        return $rules;
    }

    public function messages() {
        return [
            'attributes_values.*.required' => __('admin/proProduct.variant_err_attributes_required'),
            'attributes_values.*.min' => __('admin/proProduct.variant_err_attributes_min'),
        ];
    }

}
