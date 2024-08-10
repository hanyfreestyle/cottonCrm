<?php

namespace App\AppPlugin\Config\Apps\Request;

use Illuminate\Foundation\Http\FormRequest;

class AppSettingRequest extends FormRequest {


    public function authorize(): bool {
        return true;
    }


    public function rules(): array {


        $rules = [
            'status' => 'required',
            'baseUrl' => 'required|url',
            'mobilePrefix' => 'required',
            'prefix' => 'required',

            'ColorDark' => 'required|integer',
            'ColorLight' => 'required|integer',
            'AppBarIconColor' => 'required|integer',
            'BackGroundColor' => 'required|integer',
            'SplashColor' => 'required|integer',
            'PreloadingColor' => 'required|integer',
            'StatueBArColor' => 'required|integer',
            'AppBarColor' => 'required|integer',
            'AppBarColorText' => 'required|integer',
            'sideMenuText' => 'required|integer',
            'sideMenuColor' => 'required|integer',
            'mainScreenScale' => 'required',
            'sideMenuAngle' => 'required',
            'sideMenuStyle' => 'required',
            'AppTheme' => 'required',

            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',


            'whatsAppNumber' => 'nullable|numeric',
            'whatsAppKey' => 'nullable',

            'telegram_key' => 'nullable',
            'telegram_group' => 'nullable',
            'telegram_phone' => 'nullable',
        ];

        foreach (config('app.web_lang') as $key => $lang) {
            $rules[$key . ".whatsAppMessage"] = 'required_with:whatsAppNumber';
            $rules[$key . ".AppName"] = 'required';
        }


        return $rules;
    }
}
