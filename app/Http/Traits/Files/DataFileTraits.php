<?php

namespace App\Http\Traits\Files;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Models\CrmCustomersAddress;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\Area\Models\AreaTranslation;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\City\Models\CityTranslation;
use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use App\AppPlugin\Data\ConfigData\Models\ConfigDataTranslation;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\AppPlugin\Data\Country\Country;
use App\AppPlugin\Data\Country\CountryTranslation;
use Illuminate\Support\Facades\File;

trait DataFileTraits{


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
//        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            $newPer = getDefPermission('crm_customer', true);
//            $data = array_merge($data, $newPer);
//        }

        $manageData = [
            ['cat_id' => 'data', 'name' => 'data_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
            ['cat_id' => 'data', 'name' => 'data_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
            ['cat_id' => 'data', 'name' => 'data_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
            ['cat_id' => 'data', 'name' => 'data_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
        ];

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $newPer = [['cat_id' => 'data', 'name' => 'country_view', 'name_ar' => 'الدول', 'name_en' => 'Country']];
            $manageData = array_merge($manageData, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $newPer = [['cat_id' => 'data', 'name' => 'city_view', 'name_ar' => 'المدن', 'name_en' => 'City']];
            $manageData = array_merge($manageData, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $newPer = [['cat_id' => 'data', 'name' => 'area_view', 'name_ar' => 'المناطق', 'name_en' => 'Area']];
            $manageData = array_merge($manageData, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'LeadCategory_view', 'name_ar' => 'الحملة الاعلانية', 'name_en' => 'Lead Category']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'LeadSours_view', 'name_ar' => 'مصدر التواصل', 'name_en' => 'Lead Sours']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'BrandName_view', 'name_ar' => 'العلامة التجارية', 'name_en' => 'Brand Name']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'DeviceType_view', 'name_ar' => 'نوع الجهاز', 'name_en' => 'Device Type']];
                $manageData = array_merge($manageData, $newPer);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
                $newPer = [['cat_id' => 'data', 'name' => 'EvaluationCust_view', 'name_ar' => 'تقييم العميل', 'name_en' => 'Evaluation']];
                $manageData = array_merge($manageData, $newPer);
            }
        }

        $data = array_merge($data, $manageData);

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.data";
        $mainMenu->name = "admin.app_menu_data";
        $mainMenu->icon = "fas fa-server";
        $mainMenu->roleView = "data_view";
        $mainMenu->position = 81;
        $mainMenu->save();

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("Country");
            $subMenu->url = "admin.data.Country.index";
            $subMenu->name = "admin/dataCountry.app_menu";
            $subMenu->roleView = "country_view";
            $subMenu->icon = "fas fa-flag";
            $subMenu->save();
        }
        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("DataCity");
            $subMenu->url = "admin.data.DataCity.index";
            $subMenu->name = "admin/dataCity.app_menu";
            $subMenu->roleView = "city_view";
            $subMenu->icon = "fas fa-city";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("DataArea");
            $subMenu->url = "admin.data.DataArea.index";
            $subMenu->name = "admin/dataArea.app_menu";
            $subMenu->roleView = "area_view";
            $subMenu->icon = "fas fa-map-signs";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("EvaluationCust");
            $subMenu->url = "admin.data.EvaluationCust.index";
            $subMenu->name = "admin/data/EvaluationCust.app_menu";
            $subMenu->roleView = "EvaluationCust_view";
            $subMenu->icon = "fas fa-star";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("LeadCategory");
            $subMenu->url = "admin.data.LeadCategory.index";
            $subMenu->name = "admin/data/LeadCategory.app_menu";
            $subMenu->roleView = "LeadCategory_view";
            $subMenu->icon = "fas fa-bullhorn";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("LeadSours");
            $subMenu->url = "admin.data.LeadSours.index";
            $subMenu->name = "admin/data/LeadSours.app_menu";
            $subMenu->roleView = "LeadSours_view";
            $subMenu->icon = "fas fa-headset";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("BrandName");
            $subMenu->url = "admin.data.BrandName.index";
            $subMenu->name = "admin/data/BrandName.app_menu";
            $subMenu->roleView = "BrandName_view";
            $subMenu->icon = "far fa-copyright";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("DeviceType");
            $subMenu->url = "admin.data.DeviceType.index";
            $subMenu->name = "admin/data/DeviceType.app_menu";
            $subMenu->roleView = "DeviceType_view";
            $subMenu->icon = "fas fa-tv";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BookRelease.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("BookRelease");
            $subMenu->url = "admin.data.BookRelease.index";
            $subMenu->name = "admin/data/BookRelease.app_menu";
            $subMenu->roleView = "data_view";
            $subMenu->icon = "fas fa-book";
            $subMenu->save();
        }

        if (File::isFile(base_path('routes/AppPlugin/data/data_BookLang.php'))) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = ConfigDataTraits::selRouteList("BookLang");
            $subMenu->url = "admin.data.BookLang.index";
            $subMenu->name = "admin/data/BookLang.app_menu";
            $subMenu->roleView = "data_view";
            $subMenu->icon = "fas fa-globe";
            $subMenu->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            $addLang = ['country' => ['id' => 'country', 'group' => 'admin', 'file_name' => 'dataCountry', 'name_en' => 'Country', 'name_ar' => 'الدول']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            $addLang = ['city' => ['id' => 'city', 'group' => 'admin', 'file_name' => 'dataCity', 'name_en' => 'City', 'name_ar' => 'المدن']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            $addLang = ['area' => ['id' => 'area', 'group' => 'admin', 'file_name' => 'dataArea', 'name_en' => 'Area', 'name_ar' => 'المناطق']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
                $addLang = ['LeadCategory' => ['id' => 'LeadCategory', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'LeadCategory', 'name_en' => 'LeadCategory', 'name_ar' => 'الحملات الاعلانية']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
                $addLang = ['LeadSours' => ['id' => 'LeadSours', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'LeadSours', 'name_en' => 'LeadSours', 'name_ar' => 'مصدر التواصل']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
                $addLang = ['BrandName' => ['id' => 'BrandName', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'BrandName', 'name_en' => 'BrandName', 'name_ar' => 'العلامات التجارية']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
                $addLang = ['DeviceType' => ['id' => 'DeviceType', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'DeviceType', 'name_en' => 'DeviceType', 'name_ar' => 'انواع الاجهزة']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }

            if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
                $addLang = ['EvaluationCust' => ['id' => 'EvaluationCust', 'group' => 'admin', 'sub_dir' => 'data', 'file_name' => 'EvaluationCust', 'name_en' => 'Evaluation', 'name_ar' => 'تقييم العميل']];
                $LangMenu = array_merge($LangMenu, $addLang);
            }
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {

        if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {
            SeedDbFile(ConfigData::class, 'config_data.sql');
            SeedDbFile(ConfigDataTranslation::class, 'config_data_translations.sql');
        }

        if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
            SeedDbFile(Country::class, 'data_countries.sql', false);
            SeedDbFile(CountryTranslation::class, 'data_country_translations.sql', false);
        }

        if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
            SeedDbFile(City::class, 'data_city.sql');
            SeedDbFile(CityTranslation::class, 'data_city_translations.sql');
        }

        if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
            SeedDbFile(Area::class, 'data_area.sql');
            SeedDbFile(AreaTranslation::class, 'data_area_translations.sql');
        }

    }

}
