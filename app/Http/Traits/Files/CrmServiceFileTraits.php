<?php

namespace App\Http\Traits\Files;


use App\AppPlugin\Crm\CrmService\FollowUp\UserFollowUpController;
use App\AppPlugin\Crm\CrmService\Leads\CrmLeadsController;
use App\AppPlugin\Crm\CrmService\Tickets\CrmTicketOpenController;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\CrmService\Tickets\Models\CrmTicketsDes;
use Illuminate\Support\Facades\File;

trait CrmServiceFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/CrmService/leads.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_leads', $sendArr);
            $data = array_merge($data, $newPer);
            $newPer = [
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_distribution', 'name_ar' => 'توزيع', 'name_en' => 'Distribution'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/follow_up.php'))) {
            $newPer = [
                ['cat_id' => 'crm_tech_follow', 'name' => 'crm_tech_follow_view', 'name_ar' => 'عرض', 'name_en' => 'View'],
                ['cat_id' => 'crm_tech_follow', 'name' => 'crm_tech_follow_edit', 'name_ar' => 'تعديل', 'name_en' => 'Edit'],
                ['cat_id' => 'crm_tech_follow', 'name' => 'crm_tech_follow_filter', 'name_ar' => 'تصفية النتائج', 'name_en' => 'Filter'],
                ['cat_id' => 'crm_tech_follow', 'name' => 'crm_tech_follow_report', 'name_ar' => 'التقارير', 'name_en' => 'Report'],
                ['cat_id' => 'crm_tech_follow', 'name' => 'crm_tech_follow_admin', 'name_ar' => 'مدير نظام ', 'name_en' => 'Admin'],
                ['cat_id' => 'crm_tech_follow', 'name' => 'crm_tech_follow_team_leader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_ticket', $sendArr);
            $data = array_merge($data, $newPer);
            $newPer = [
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_admin', 'name_ar' => 'مدير نظام ', 'name_en' => 'Admin'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_team_leader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
            ];
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

        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
            CrmTicketOpenController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/CrmService/follow_up.php'))) {
            UserFollowUpController::AdminMenu();
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
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/AppPlugin/CrmService/ticket_open.php'))) {
            SeedDbFile(CrmTickets::class, 'crm_ticket.sql');
            SeedDbFile(CrmTicketsDes::class, 'crm_ticket_des.sql');
        }
    }

}
