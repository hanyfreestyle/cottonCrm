<?php

namespace App\Http\Traits\Files;

use  App\AppPlugin\Models\Faq\Seeder\FaqSeeder;
use App\AppPlugin\Pages\Models\Page;
use App\AppPlugin\Pages\Models\PageCategory;
use App\AppPlugin\Pages\Models\PageCategoryTranslation;
use App\AppPlugin\Pages\Models\PagePhoto;
use App\AppPlugin\Pages\Models\PagePhotoTranslation;
use App\AppPlugin\Pages\Models\PagePivot;
use App\AppPlugin\Pages\Models\PageTags;
use App\AppPlugin\Pages\Models\PageTagsPivot;
use App\AppPlugin\Pages\Models\PageTagsTranslation;
use App\AppPlugin\Pages\Models\PageTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

trait MainModelFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {
//        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            $newPer = getDefPermission('crm_customer', true);
//            $data = array_merge($data, $newPer);
//        }

        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $newPer = [
                ['cat_id' => 'Blog', 'name' => 'Blog_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Blog', 'name' => 'Blog_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Blog', 'name' => 'Blog_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Blog', 'name' => 'Blog_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Blog', 'name' => 'Blog_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Blog', 'name' => 'Blog_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/pages.php'))) {
            $newPer = [
                ['cat_id' => 'Pages', 'name' => 'Pages_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Pages', 'name' => 'Pages_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Pages', 'name' => 'Pages_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Pages', 'name' => 'Pages_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Pages', 'name' => 'Pages_teamleader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
                ['cat_id' => 'Pages', 'name' => 'Pages_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Pages', 'name' => 'Pages_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }


        if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
            $newPer = [
                ['cat_id' => 'Faq', 'name' => 'Faq_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Faq', 'name' => 'Faq_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Faq', 'name' => 'Faq_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Faq', 'name' => 'Faq_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Faq', 'name' => 'Faq_edit_slug', 'name_ar' => 'تعديل الرابط', 'name_en' => 'Edit Slug'],
                ['cat_id' => 'Faq', 'name' => 'Faq_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            $newPer = [
                ['cat_id' => 'FileManager', 'name' => 'FileManager_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'FileManager', 'name' => 'FileManager_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'FileManager', 'name' => 'FileManager_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'FileManager', 'name' => 'FileManager_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
            ];
            $data = array_merge($data, $newPer);
        }

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            CrmCustomersController::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/model/faq.php'))) {
            $addLang = ['faq' => ['id' => 'faq', 'group' => 'admin', 'file_name' => 'faq', 'name' => 'Faq', 'name_ar' => 'الاسئلة المتكررة'],];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            $addLang = ['fileManager' => ['id' => 'fileManager', 'group' => 'admin', 'file_name' => 'fileManager', 'name' => 'fileManager', 'name_ar' => 'ميديا فايل']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/blog.php'))) {
            $addLang = ['blogPost' => ['id' => 'blogPost', 'group' => 'admin', 'file_name' => 'blogPost', 'name' => 'Blog Post', 'name_ar' => 'المقالات']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {
            $LangMenu = MainPostPermissionTraits::LoadLangFiles($LangMenu);
        }


        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {





//        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
//            SeedDbFile(CrmCustomers::class, 'crm_customers.sql');
//            SeedDbFile(CrmCustomersAddress::class, 'crm_customers_address.sql');
//        }


//        if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {
//            $this->call(MainPostSeeder::class);
//        }
//



//        if (File::isFile(base_path('routes/AppPlugin/crm/ImportData.php'))) {
//            $this->call(ImportDataSeeder::class);
//        }


    }

}
