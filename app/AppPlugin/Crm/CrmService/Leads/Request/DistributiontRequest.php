<?php

namespace App\AppPlugin\Crm\CrmService\Leads\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DistributiontRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(Request $request): array {
        $rules = [
            "ids" => "required|array|min:1|max:50",
            'user_id' => "required",
        ];

        $rules += [

        ];
        return $rules;
    }

    public function messages() {
        return [
            'user_id.required' => __('admin/crm.distribution_err_user'),
            'ids.required' => __('admin/crm.distribution_err_req'),
            'ids.min' => __('admin/crm.distribution_err_min'),
            'ids.max' => __('admin/crm.distribution_err_max'),
        ];
    }


}
