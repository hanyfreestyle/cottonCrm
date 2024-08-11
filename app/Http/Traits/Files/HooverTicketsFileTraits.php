<?php

namespace App\Http\Traits\Files;


use App\AppPlugin\Crm\Leads\CrmLeadsController;
use App\AppPlugin\Crm\Tickets\CrmTicketFollowUpController;
use App\AppPlugin\Crm\Tickets\Models\CrmTickets;
use App\AppPlugin\Crm\Tickets\Models\CrmTicketsDes;
use App\AppPlugin\Crm\TicketsTechFollow\CrmTicketTechFollowController;
use Illuminate\Support\Facades\File;

trait HooverTicketsFileTraits {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadPermission($data) {

        if (File::isFile(base_path('routes/AppPlugin/crm/leads.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_leads', $sendArr);
            $data = array_merge($data, $newPer);
            $newPer = [
                ['cat_id' => 'crm_leads', 'name' => 'crm_leads_distribution', 'name_ar' => 'توزيع', 'name_en' => 'Distribution'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
            $sendArr = ['report' => 1, 'filter' => 1];
            $newPer = getDefPermission('crm_ticket', $sendArr);
            $data = array_merge($data, $newPer);
            $newPer = [
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_admin', 'name_ar' => 'مدير نظام ', 'name_en' => 'Admin'],
                ['cat_id' => 'crm_ticket', 'name' => 'crm_ticket_team_leader', 'name_ar' => 'مشرف عام', 'name_en' => 'Team Leader'],
            ];
            $data = array_merge($data, $newPer);
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket_tech_follow.php'))) {
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

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadMenu() {
        if (File::isFile(base_path('routes/AppPlugin/crm/leads.php'))) {
            CrmLeadsController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
            CrmTicketFollowUpController::AdminMenu();
        }

        if (File::isFile(base_path('routes/AppPlugin/crm/ticket_tech_follow.php'))) {
            CrmTicketTechFollowController::AdminMenu();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

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
    static function LoadSeeder() {
        if (File::isFile(base_path('routes/AppPlugin/crm/ticket.php'))) {
            SeedDbFile(CrmTickets::class, 'crm_ticket.sql');
            SeedDbFile(CrmTicketsDes::class, 'crm_ticket_des.sql');
        }
    }

}
