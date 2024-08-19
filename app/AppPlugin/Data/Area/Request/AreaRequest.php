<?php

namespace App\AppPlugin\Data\Area\Request;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AreaRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        if (config('AppPlugin.Area.seo')) {
            $data = $this->toArray();
            foreach (config('app.web_lang') as $key => $lang) {
                data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
            }
            $this->merge($data);
        }
    }

    public function rules(Request $request): array {
        $addLang = config('app.web_lang');
        $AppPlugin = config('AppPlugin.Area');

        if ($AppPlugin['seo']) {
            foreach (config('app.web_lang') as $key => $lang) {
                $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
            }
        }

        $id = $this->route('id');

        $rules = [
            'test' => "nullable",
        ];

        if ($AppPlugin['add_photo']) {
            $rules += [
                'image' => "nullable|mimes:jpg,jpeg,png,webp|max:1000",
            ];
        }
        if ($AppPlugin['add_country']) {
            $rules += [
                'country_id' => "required",
            ];
        }
        if ($AppPlugin['add_city']) {
            $rules += [
                'city_id' => "required",
            ];
        }

        $rules += AdminMainController::FormRequestDataSeo($id, $addLang, $AppPlugin['seo'], 'data_area_translations', 'area_id');

        return $rules;
    }


}
