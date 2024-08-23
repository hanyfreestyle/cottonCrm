<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrmService {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'CrmLeads' => self::treeCrmLeads(),
//            'CrmTickets' => self::treeCrmTickets(),
//            'CrmTechFollow' => self::treeCrmTechFollow(),
//            'BrandName' => self::treeBrandName(),
//            'DeviceType' => self::treeDeviceType(),
//            'Evaluation' => self::treeEvaluation(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmLeads() {
        return [
            'view' => true,
            'id' => "CrmLeads",
            'CopyFolder' => "CrmService_Leads",
            'appFolder' => 'Crm/CrmService/Leads',
            'viewFolder' => 'CrmService/leads',
            'routeFolder' => "CrmService/",
            'routeFile' => 'leads.php',
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['leads.php'],
            'ComponentFolderClass' => ['AppPlugin/CrmService/Leads'],
            'ComponentFolderView' => ['app-plugin/crm-service/leads'],
        ];
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmTickets() {
        return [
            'view' => true,
            'id' => "CrmTickets",
            'CopyFolder' => "Crm_Tickets",
            'appFolder' => 'Crm/Tickets',
            'viewFolder' => 'CrmTickets',
            'routeFolder' => "crm/",
            'routeFile' => 'ticket.php',
            'migrations' => [
                '2021_01_01_000002_create_crm_tickets_table.php',
            ],
            'adminLangFolder' => "admin/crm/",
            'adminLangFiles' => ['ticket.php'],
            'ComponentFolderClass' => ['AppPlugin/Crm/Ticket'],
            'ComponentFolderView' => ['app-plugin/crm/ticket'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmTechFollow() {
        return [
            'view' => true,
            'id' => "CrmTechFollow",
            'CopyFolder' => "Crm_TechFollow",
            'appFolder' => 'Crm/TicketsTechFollow',
            'viewFolder' => 'CrmTechFollow',
            'routeFolder' => "crm/",
            'routeFile' => 'ticket_tech_follow.php',
        ];
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeBrandName() {
        return [
            'view' => true,
            'id' => "BrandName",
            'CopyFolder' => "DataBrandName",
            'appFolder' => 'Data/DataBrandName',
            'routeFolder' => "data/",
            'routeFile' => 'data_BrandName.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['BrandName.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeDeviceType() {
        return [
            'view' => true,
            'id' => "DeviceType",
            'CopyFolder' => "DataDeviceType",
            'appFolder' => 'Data/DataDeviceType',
            'routeFolder' => "data/",
            'routeFile' => 'data_DeviceType.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['DeviceType.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeEvaluation() {
        return [
            'view' => true,
            'id' => "Evaluation",
            'CopyFolder' => "DataEvaluationCust",
            'appFolder' => 'Data/DataEvaluationCust',
            'routeFolder' => "data/",
            'routeFile' => 'data_EvaluationCust.php',
            'adminLangFolder' => "admin/data/",
            'adminLangFiles' => ['EvaluationCust.php'],
        ];
    }

}
