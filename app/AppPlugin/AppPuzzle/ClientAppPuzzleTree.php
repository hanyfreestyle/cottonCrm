<?php

namespace App\AppPlugin\AppPuzzle;

class ClientAppPuzzleTree {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function tree() {
        $modelTree = [
            'hoover' => self::treeClientData('hoover'),
            'bookcaffe' => self::treeClientData('bookcaffe'),
            'vonza' => self::treeClientData('vonza'),
//            'cotton' => self::treeClientData('cotton'),
        ];
        return $modelTree;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function treeClientData($folderName) {
//        dd(public_path('assets\admin\client/'.$folderName));
        return [
            'view' => true,
            'folderName' => $folderName,
            'id' => $folderName,
            'CopyFolder' => "_Clients/" . $folderName,
            'FolderList' => [
                'db' => public_path('db/' . $folderName),
                'config' => base_path('config_' . $folderName),
                'adminLogo' => public_path('assets\admin\client/' . $folderName),
            ],
        ];
    }

}
