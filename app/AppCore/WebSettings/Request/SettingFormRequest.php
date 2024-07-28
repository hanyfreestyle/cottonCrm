<?php


namespace App\AppCore\WebSettings\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class SettingFormRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }


    public function rules(): array {

        $rules = [
            'web_status' => 'required',

            'phone_num' => 'required',
            'whatsapp_num' => 'required',
            'phone_call' => 'required|numeric',
            'whatsapp_send' => 'required|numeric',
            'email' => 'required|email',
            'def_url' => 'required|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'google_api' => 'nullable',


            'switch_lang' => 'required',
            'users_login' => 'required',
            'serach' => 'required',
            'serach_type' => 'required',
            'wish_list' => 'required',
        ];

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $rules += [
                'page_about' => 'required',
                'page_warranty' => 'required',
                'page_shipping' => 'required',
                'pro_sale_lable' => 'required',
                'pro_quick_view' => 'required',
                'pro_quick_shop' => 'required',
                'pro_warranty_tab' => 'required',
                'pro_shipping_tab' => 'required',
                'pro_social_share' => 'required',

            ];
        }

        $rules += [
            'schema_type' => 'required|alpha',
            'schema_lat'=> "nullable|numeric|required_with:schema_lat",
            'schema_long'=> "nullable|numeric|required_with:schema_long",
            'schema_country' => 'required|alpha',
            'schema_postal_code'=> 'required|regex:/^[0-9]{3,7}$/',
        ];

        foreach (config('app.web_lang') as $key => $lang) {
            $rules[$key . ".name"] = 'required';
            $rules[$key . ".closed_mass"] = 'required';
            $rules[$key . ".schema_address"] = 'required';
            $rules[$key . ".schema_city"] = 'required';
        }
        return $rules;
    }
}
