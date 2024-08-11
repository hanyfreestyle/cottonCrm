<?php

namespace App\AppCore\Menu;

use App\AppCore\AdminRole\PermissionController;
use App\AppCore\LangFile\LangFileController;


use App\AppCore\WebSettings\Traits\WebSettingsConfigTraits;
use App\AppPlugin\BlogPost\BlogCategoryController;
use App\AppPlugin\Config\Apps\AppSettingController;
use App\AppPlugin\Config\WebLangFile\LangFileWebController;
use App\AppPlugin\CustomersAdmin\CustomerAdminController;
use App\AppPlugin\Data\ConfigData\Traits\ConfigDataTraits;
use App\AppPlugin\Faq\FaqCategoryController;
use App\AppPlugin\FileManager\FileBrowserController;
use App\AppPlugin\Leads\ContactUs\ContactUsFormController;
use App\AppPlugin\Models\BlogPost\BlogPostCategoryController;
use App\AppPlugin\Orders\OrderController;
use App\AppPlugin\Pages\PageCategoryController;
use App\AppPlugin\Product\ProductController;


use App\Http\Traits\CrmFunTraits;
use App\Http\Traits\Files\AppSettingFileTraits;
use App\Http\Traits\Files\CustomersFileTraits;
use App\Http\Traits\Files\DataFileTraits;
use App\Http\Traits\Files\HooverTicketsFileTraits;
use App\Http\Traits\Files\PeriodicalsFileTraits;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class AdminMenuSeeder extends Seeder {

    public function run(): void {

        AppSettingFileTraits::LoadMenu();

        WebSettingsConfigTraits::LoadMenu();
        WebSettingsConfigTraits::LoadWebLangMenu();

        PermissionController::AdminMenu();
        LangFileController::AdminMenu();

        PeriodicalsFileTraits::LoadMenu();
        CustomersFileTraits::LoadMenu();
        HooverTicketsFileTraits::LoadMenu();


        DataFileTraits::LoadMenu();








        if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {
            if (File::isFile(base_path('routes/AppPlugin/model/blogPost.php'))) {
                $loadMenu = new BlogPostCategoryController;
                $loadMenu->LoadAdminMenu();
            }
        }


        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {
            BlogCategoryController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/faq.php'))) {
            FaqCategoryController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            PageCategoryController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            FileBrowserController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            ProductController::AdminMenu();
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
            $menu->postion = $menu->id;
            $menu->save();
        }

        Cache::forget('CashAdminMenuList');
    }
}
