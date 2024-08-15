<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ConfigModelUpdateRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $this->model_id  = $this->get('model_id'). "_";
    }


    public function rules(Request $request): array {
        $model_id = $request->input('model_id') . "_";
        return [
            $model_id . 'perpage' => "sometimes|required|integer|in:10,25,50,100",
            $model_id . 'filterid' => "sometimes|required",
            $model_id . 'iconfilterid' => "sometimes|required",
            $model_id . 'morephoto_filterid' => "sometimes|required",
        ];
    }

    public function messages() {

        return [
            $this->model_id.'perpage.in' => __('validation.per_page'),
            $this->model_id.'filterid.required' => __('validation.req'),
            $this->model_id.'iconfilterid.required' => __('validation.req'),
            $this->model_id.'morephoto_filterid.required' => __('validation.req'),
        ];
    }

}
