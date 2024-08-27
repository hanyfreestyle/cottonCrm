<?php

namespace App\Http\Traits\Files;


use App\AppPlugin\Crm\CrmService\FollowUp\UserFollowUpController;
use App\AppPlugin\Crm\CrmService\Leads\CrmLeadsController;
use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketCashController;
use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketClosedController;
use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketOpenController;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsCash;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsDes;
use Illuminate\Support\Facades\File;

trait CrmServiceFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_service_leads', $sendArr);
            $data = array_merge($data, $newPer);
            $newPer = [
                ['cat_id' => 'crm_service_leads', 'name' => 'crm_service_leads_distribution', 'name_ar' => 'توزيع', 'name_en' => 'Distribution'],
            ];
            $data = array_merge($data, $newPer);

        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/follow_up.php'))) {
            $newPer = [
                ['cat_id' => 'crm_service_follow', 'name' => 'crm_service_follow_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'crm_service_follow', 'name' => 'crm_service_follow_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'crm_service_follow', 'name' => 'crm_service_follow_filter', 'name_ar' => 'تصفية النتائج', 'name_en' => 'Filter'],
                ['cat_id' => 'crm_service_follow', 'name' => 'crm_service_follow_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'crm_service_follow', 'name' => 'crm_service_follow_admin', 'name_ar' => 'مدير نظام ', 'name_en' => 'Admin'],
                ['cat_id' => 'crm_service_follow', 'name' => 'crm_service_follow_team_leader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_service_open_ticket', $sendArr);
            $data = array_merge($data, $newPer);
            $newPer = [
                ['cat_id' => 'crm_service_open_ticket', 'name' => 'crm_service_open_ticket_admin', 'name_ar' => 'مدير نظام ', 'name_en' => 'Admin'],
                ['cat_id' => 'crm_service_open_ticket', 'name' => 'crm_service_open_ticket_team_leader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_close.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_service_close_ticket', $sendArr);
            $data = array_merge($data, $newPer);
//            $newPer = [
//                ['cat_id' => 'crm_service_open_ticket', 'name' => 'crm_service_open_ticket_admin', 'name_ar' => 'مدير نظام ', 'name_en' => 'Admin'],
//                ['cat_id' => 'crm_service_open_ticket', 'name' => 'crm_service_open_ticket_team_leader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
//            ];
//            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_cash.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_service_cash', $sendArr);
            $data = array_merge($data, $newPer);
        }

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
            CrmLeadsController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/follow_up.php'))) {
            UserFollowUpController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
            CrmTicketOpenController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_close.php'))) {
            CrmTicketClosedController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_cash.php'))) {
            CrmTicketCashController::AdminMenu();
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/crm/crmCore.php'))) {
            $addLang = ['DefCrm' => ['id' => 'DefCrm', 'group' => 'admin', 'sub_dir' => null,
                'file_name' => 'crm', 'name_en' => 'Crm', 'name_ar' => 'Crm']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }


        if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
            $addLang = ['CrmService' => ['id' => 'CrmService', 'group' => 'admin', 'sub_dir' => null,
                'file_name' => 'crm_service', 'name_en' => 'CrmService', 'name_ar' => 'CrmService']];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['CrmServiceVar' => ['id' => 'CrmServiceVar', 'group' => 'admin', 'sub_dir' => null,
                'file_name' => 'crm_service_var', 'name_en' => 'CrmServiceVar', 'name_ar' => 'CrmServiceVar']];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['CrmServiceMenu' => ['id' => 'CrmServiceMenu', 'group' => 'admin', 'sub_dir' => null,
                'file_name' => 'crm_service_menu', 'name_en' => 'CrmServiceMenu', 'name_ar' => 'CrmServiceMenu']];
            $LangMenu = array_merge($LangMenu, $addLang);

            $addLang = ['CrmServiceMass' => ['id' => 'CrmServiceMass', 'group' => 'admin', 'sub_dir' => null,
                'file_name' => 'crm_service_mass', 'name_en' => 'CrmServiceMass', 'name_ar' => 'CrmServiceMass']];
            $LangMenu = array_merge($LangMenu, $addLang);

        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
            SeedDbFile(CrmTickets::class, 'crm_ticket.sql');
            SeedDbFile(CrmTicketsDes::class, 'crm_ticket_des.sql');
            SeedDbFile(CrmTicketsCash::class, 'crm_ticket_cash.sql');
        }
    }

}
