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
        ];

        if (config('app.WEB_VIEW')) {
            $rules += ['web_status' => 'required'];
        }

        if (config('app.WEB_VIEW') and count(config('app.web_lang')) > 1) {
            $rules += ['switch_lang' => 'required'];
        }

        if (config('app.USER_LOGIN')) {
            $rules += ['users_login' => 'required'];
        }


        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {

        }

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
                'serach' => 'required',
                'serach_type' => 'required',
                'wish_list' => 'required',
            ];
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $rules += [
                'schema_type' => 'required|alpha',
                'schema_lat' => "nullable|numeric|required_with:schema_lat",
                'schema_long' => "nullable|numeric|required_with:schema_long",
                'schema_country' => 'required|alpha',
                'schema_postal_code' => 'required|regex:/^[0-9]{3,7}$/',
            ];
        }


        foreach (config('app.web_lang') as $key => $lang) {
            if (config('app.WEB_VIEW')) {
                $rules[$key . ".name"] = 'required';
                $rules[$key . ".closed_mass"] = 'required';
            }
            if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
                $rules[$key . ".schema_address"] = 'required';
                $rules[$key . ".schema_city"] = 'required';
            }
        }
        return $rules;
    }
}
