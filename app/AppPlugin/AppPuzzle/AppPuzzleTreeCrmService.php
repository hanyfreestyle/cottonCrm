<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeCrmService {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'CrmService' => self::treeCrmService(),
            'BrandName' => self::treeBrandName(),
            'DeviceType' => self::treeDeviceType(),
            'Evaluation' => self::treeEvaluation(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeCrmService() {
        return [
            'view' => true,
            'id' => "CrmService",
            'CopyFolder' => "CrmService",
            'appFolder' => 'Crm/CrmService',
            'viewFolder' => 'CrmService',
            'routeFolder' => "CrmService/",
            'routeFiles' => ['leads.php','follow_up.php','ticket_open.php','ticket_close.php','ticket_cash.php','ticket_review.php'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['crm_service.php','crm_service_menu.php','crm_service_var.php','crm_service_mass.php'],
            'ComponentFolderClass' => ['AppPlugin/CrmService'],
            'ComponentFolderView' => ['app-plugin/crm-service'],
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
