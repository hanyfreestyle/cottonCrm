<?php

namespace App\AppCore\WebSettings;

use App\AppCore\WebSettings\Models\Setting;
use App\AppCore\WebSettings\Models\SettingTranslation;
use App\AppCore\WebSettings\Request\SettingFormRequest;
use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Pages\Models\Page;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class SettingsController extends AdminMainController {

    function __construct() {

        parent::__construct();
        $this->controllerName = "config";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/webConfig.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddButToCard' => false,
        ];
        self::loadConstructData($sendArr);

        $this->middleware('permission:config_edit', ['only' => ['webConfigUpdate']]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('WebConfig_Cash');
        Cache::forget('CashCityList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   webConfigEdit
    public function webConfigEdit() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $setting = Setting::findOrFail(1);
        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            $pagesList = Page::all();
        } else {
            $pagesList = [];
        }

        View::share('pagesList', $pagesList);

        return view('admin.appCore.config.settingWeb')->with([
            'pageData' => $pageData,
            'setting' => $setting,
        ]);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function webConfigUpdate(SettingFormRequest $request) {

        $saveData = Setting::findorfail('1');
        $saveData->web_status = $request->input('web_status');
        $saveData->switch_lang = $request->input('switch_lang');
        $saveData->users_login = $request->input('users_login');


        $saveData->phone_num = $request->input('phone_num');
        $saveData->whatsapp_num = $request->input('whatsapp_num');
        $saveData->phone_call = $request->input('phone_call');
        $saveData->whatsapp_send = $request->input('whatsapp_send');
        $saveData->email = $request->input('email');
        $saveData->def_url = $request->input('def_url');

        if (config('app.WEB_VIEW')) {
            $saveData->facebook = $request->input('facebook');
            $saveData->youtube = $request->input('youtube');
            $saveData->twitter = $request->input('twitter');
            $saveData->instagram = $request->input('instagram');
            $saveData->linkedin = $request->input('linkedin');
            $saveData->google_api = $request->input('google_api');
        }


        if (config('app.CONFIG_TELEGRAM')) {
            $saveData->telegram_send = $request->input('telegram_send');
            $saveData->telegram_key = $request->input('telegram_key');
            $saveData->telegram_phone = $request->input('telegram_phone');
            $saveData->telegram_group = $request->input('telegram_group');
        }


        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $saveData->page_about = $request->input('page_about');
            $saveData->page_warranty = $request->input('page_warranty');
            $saveData->page_shipping = $request->input('page_shipping');
            $saveData->pro_sale_lable = $request->input('pro_sale_lable');
            $saveData->pro_quick_view = $request->input('pro_quick_view');
            $saveData->pro_quick_shop = $request->input('pro_quick_shop');
            $saveData->pro_warranty_tab = $request->input('pro_warranty_tab');
            $saveData->pro_shipping_tab = $request->input('pro_shipping_tab');
            $saveData->pro_social_share = $request->input('pro_social_share');
            $saveData->wish_list = $request->input('wish_list');
            $saveData->serach = $request->input('serach');
            $saveData->serach_type = $request->input('serach_type');
        }

        if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
            $saveData->schema_type = $request->input('schema_type');
            $saveData->schema_lat = $request->input('schema_lat');
            $saveData->schema_long = $request->input('schema_long');
            $saveData->schema_postal_code = $request->input('schema_postal_code');
            $saveData->schema_country = $request->input('schema_country');
        }


        $saveData->save();

        foreach (config('app.web_lang') as $key => $lang) {
            $saveTranslation = SettingTranslation::where('setting_id', $saveData->id)->where('locale', $key)->firstOrNew();
            $saveTranslation->locale = $key;

            if (config('app.WEB_VIEW')) {
                $saveTranslation->name = $request->input($key . '.name');
                $saveTranslation->closed_mass = $request->input($key . '.closed_mass');
                $saveTranslation->meta_des = $request->input($key . '.meta_des');
                $saveTranslation->whatsapp_des = $request->input($key . '.whatsapp_des');
            }

            if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
                $saveTranslation->schema_address = $request->input($key . '.schema_address');
                $saveTranslation->schema_city = $request->input($key . '.schema_city');
            }

            $saveTranslation->save();
        }

        self::ClearCash();
        return back()->with('Edit.Done', "");
    }



}
