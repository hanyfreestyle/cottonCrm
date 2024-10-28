<?php

namespace App\AppCore\Menu;

use App\AppCore\AdminRole\PermissionController;
use App\AppCore\LangFile\LangFileController;


use App\AppCore\WebSettings\Traits\WebSettingsConfigTraits;
use App\AppPlugin\Config\Apps\AppSettingController;
use App\AppPlugin\Config\WebLangFile\LangFileWebController;
use App\AppPlugin\CustomersAdmin\CustomerAdminController;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use  App\AppPlugin\Models\Faq\FaqCategoryController;
use App\AppPlugin\FileManager\FileBrowserController;
use App\AppPlugin\Leads\ContactUs\ContactUsFormController;

use App\AppPlugin\Models\BlogPost\BlogCategoryController;
use App\AppPlugin\Models\BlogPost\BlogPostCategoryController;
use App\AppPlugin\Orders\OrderController;
use App\AppPlugin\Models\Pages\PageCategoryController;
use App\AppPlugin\Product\ProductController;

use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\CrmServiceFileTraits;
use App\Http\Traits\Files\CustomersFileTraits;
use App\Http\Traits\Files\DataFileTraits;

use App\Http\Traits\Files\MainModelFileTraits;
use App\Http\Traits\Files\PeriodicalsFileTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class AdminMenuSeeder extends Seeder {

    public function run(): void {

        PermissionController::AdminMenu();
        AppSettingFileTraits::LoadMenu();
        DataFileTraits::LoadMenu();
        LangFileController::AdminMenu();

        PeriodicalsFileTraits::LoadMenu();
        CustomersFileTraits::LoadMenu();
        CrmServiceFileTraits::LoadMenu();

        MainModelFileTraits::LoadMenu();

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            ProductConfigTraits::getAdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
            CustomerAdminController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
            OrderController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
            ContactUsFormController::AdminMenu();
        }

        $updateMenuPostion = AdminMenu::query()->where('parent_id','!=',null)->get();

        foreach ($updateMenuPostion as $menu){
            $menu->position = $menu->id;
            $menu->save();
        }

        $moveMenu = false;
        $menuView = "crm_service_cash_view";
        if($moveMenu){
            $updateMenuPostion = AdminMenu::query()->where('type', 'Many')->get();
            foreach ($updateMenuPostion as $menu){
                if( $menu->roleView == $menuView){
                    $menu->position = 1;
                }else{
                    $menu->position = $menu->id+1;
                }
                $menu->save();
            }
        }

        Cache::forget('CashAdminMenuList');
    }
}
