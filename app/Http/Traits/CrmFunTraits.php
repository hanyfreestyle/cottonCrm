<?php

namespace App\Http\Traits;

use App\AppPlugin\Crm\Customers\CrmCustomersController;
use App\AppPlugin\Crm\Leads\CrmLeadsController;
use App\AppPlugin\Crm\Periodicals\PeriodicalsController;
use App\AppPlugin\Crm\Tickets\CrmTicketsController;
use Illuminate\Support\Facades\File;

trait CrmFunTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu(){
        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            PeriodicalsController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/leads.php'))) {
            CrmLeadsController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
             CrmTicketsController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            CrmCustomersController::AdminMenu();
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $addLang = ['CrmCustomers' => ['id' => 'CrmCustomers', 'group' => 'admin', 'sub_dir' => 'crm', 'file_name' => 'customers', 'name_en' => 'Customers', 'name_ar' => 'العملاء']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/leads.php'))) {
            $addLang = ['CrmLeads' => ['id' => 'CrmLeads', 'group' => 'admin', 'sub_dir' => 'crm',
                'file_name' => 'leads', 'name_en' => 'Leads', 'name_ar' => 'Leads']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
            $addLang = ['CrmTicket' => ['id' => 'CrmTicket', 'group' => 'admin', 'sub_dir' => 'crm',
                'file_name' => 'ticket', 'name_en' => 'Ticket', 'name_ar' => 'Ticket']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
            $newPer = [
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'Periodicals', 'name' => 'Periodicals_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
            $newPer = [
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'crm_customer', 'name' => 'crm_customer_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/leads.php'))) {
            $newPer = [
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
            $newPer = [
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_add', 'name_ar' => 'اضافة', 'name_en' => 'Add'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_delete', 'name_ar' => 'حذف', 'name_en' => 'Delete'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_restore', 'name_ar' => 'استعادة المحذوف', 'name_en' => 'Restore'],
            ];
            $data = array_merge($data, $newPer);
        }
        return $data;
    }





}
