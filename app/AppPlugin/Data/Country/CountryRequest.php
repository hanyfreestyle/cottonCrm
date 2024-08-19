<?php

namespace App\AppPlugin\Data\Country;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CountryRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        if(config('AppPlugin.Country.seo')) {
            $data = $this->toArray();
            foreach (config('app.web_lang') as $key => $lang) {
                data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
            }
            $this->merge($data);
        }

    }

    public function rules(Request $request): array {
        if(config('AppPlugin.Country.seo')) {
            foreach (config('app.web_lang') as $key => $lang) {
                $request->merge([$key . '.slug' => AdminHelper::Url_Slug($request[$key]['slug'])]);
            }
        }


        $id = $this->route('id');

        $rules = [
            'symbol' => "required",
            'currency_code' => "required|alpha",
            'continent_code' => "required|min:2|max:2|alpha",
            'language_codes' => "required",
            'time_zone' => "required",
//            'hany' => "required",
        ];

        if($id == '0') {
            $rules += [
                'iso2' => "required|min:2|max:2|unique:data_countries",
                'iso3' => "required|min:3|max:3|alpha|unique:data_countries",
                'fips' => "required|min:2|max:2|alpha|unique:data_countries",
                'iso_numeric' => "required|numeric|unique:data_countries",
                'phone' => "required|numeric|unique:data_countries",
            ];
        } else {
            $rules += [
                'iso2' => "required|min:2|max:2|alpha|unique:data_countries,iso2,$id",
                'iso3' => "required|min:3|max:3|alpha|unique:data_countries,iso3,$id",
                'fips' =>"required|min:2|max:2|alpha|unique:data_countries,fips,$id",
                'iso_numeric' => "required|numeric|unique:data_countries,iso_numeric,$id",
                'phone' => "required|numeric|unique:data_countries,phone,$id",
            ];
       }

        foreach (config('app.admin_lang') as $key => $lang) {
            $rules[$key . ".capital"] = 'required';
            $rules[$key . ".currency"] = 'required';
            $rules[$key . ".continent"] = 'required';
            $rules[$key . ".nationality"] = 'required';
        }

        foreach (config('app.admin_lang') as $key => $lang) {
            if($id == '0') {
                $rules[$key . ".name"] = "required|unique:data_country_translations,name";
            } else {
                $rules[$key . ".name"] = "required|unique:data_country_translations,name,$id,country_id,locale,$key";
            }
        }

        if(config('AppPlugin.Country.seo')) {
            foreach (config('app.web_lang') as $key => $lang) {
                if($id == '0') {
                    $rules[$key . ".g_title"] = "required";
                    $rules[$key . ".g_des"] = "required";
                    $rules[$key . ".slug"] = "required|unique:data_country_translations,slug";
                } else {
                    $rules[$key . ".g_title"] = "required";
                    $rules[$key . ".g_des"] = "required";
                    $rules[$key . ".slug"] = "required|unique:data_country_translations,slug,$id,country_id,locale,$key";
                }
            }
        }


        return $rules;
    }


}
