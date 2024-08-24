<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrmService {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'CrmServiceLeads' => self::treeCrmLeads(),
            'CrmServiceFollowUp' => self::treeCrmFollowUp(),
            'CrmServiceTickets' => self::treeCrmTickets(),
            'BrandName' => self::treeBrandName(),
            'DeviceType' => self::treeDeviceType(),
            'Evaluation' => self::treeEvaluation(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmLeads() {
        return [
            'view' => true,
            'id' => "CrmServiceLeads",
            'CopyFolder' => "CrmService_Leads",
            'appFolder' => 'Crm/CrmService/Leads',
            'viewFolder' => 'CrmService/leads',
            'routeFolder' => "CrmService/",
            'routeFile' => 'leads.php',
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['crm_service.php'],
            'ComponentFolderClass' => ['AppPlugin/CrmService/Leads'],
            'ComponentFolderView' => ['app-plugin/crm-service/leads'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmFollowUp() {
        return [
            'view' => true,
            'id' => "CrmServiceFollowUp",
            'CopyFolder' => "CrmService_FollowUp",
            'appFolder' => 'Crm/CrmService/FollowUp',
            'viewFolder' => 'CrmService/followUp',
            'routeFolder' => "CrmService/",
            'routeFile' => 'follow_up.php',
            'ComponentFolderClass' => ['AppPlugin/CrmService/FollowUp'],
            'ComponentFolderView' => ['app-plugin/crm-service/follow-up'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmTickets() {
        return [
            'view' => true,
            'id' => "CrmServiceTickets",
            'CopyFolder' => "CrmService_Tickets",
            'appFolder' => 'Crm/CrmService/Tickets',
            'viewFolder' => 'CrmService/ticketOpen',
            'routeFolder' => "CrmService/",
            'routeFile' => 'ticket_open.php',
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['crm_service_var.php'],
            'migrations' => [
                '2021_01_01_000002_create_crm_tickets_table.php',
            ],
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
