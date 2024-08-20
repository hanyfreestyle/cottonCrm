<?php

namespace App\AppCore\LangFile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class LangFileIndexController extends Controller {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       Index Page
    public function index() {

        $AppLang = [
            'ar' => 'العربية',
            'en' => 'English',
        ];
        $LangMenu = self::getLangMenu();
        $rowData = self::getDataTableLang($LangMenu, $AppLang);

        return view('index')->with(
            [
                'rowData' => $rowData,
                'LangMenu' => $LangMenu,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function getLangMenu() {
        $LangMenu = [
            'def' => ['id' => 'def', 'group' => 'admin', 'file_name' => 'def', 'name_en' => 'Default Variables', 'name_ar' => 'المتغيرات الاساسية'],
            'defCat' => ['id' => 'defCat', 'group' => 'admin', 'file_name' => 'defCat', 'name_en' => 'Variables', 'name_ar' => 'متغيرات'],
            'webConfig' => ['id' => 'webConfig', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'webConfig', 'name' => 'web Config', 'name_ar' => 'اعدادات الموقع'],
            'roles' => ['id' => 'roles', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'roles', 'name' => 'Permissions', 'name_ar' => 'الصلاحيات'],
            'form' => ['id' => 'form', 'group' => 'admin', 'file_name' => 'form', 'name_en' => 'Forms', 'name_ar' => 'الفورم'],
        ];

        $LangMenu = self::LoadLangFiles($LangMenu);
        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function LoadLangFiles($LangMenu) {

        if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
            $addLang = ['Apps' => ['id' => 'Apps', 'group' => 'admin', 'file_name' => 'configApp', 'name' => 'AppSetting', 'name_ar' => 'اعدادات التطبيق'],];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
            $addLang = ['Privacy' => ['id' => 'Privacy', 'group' => 'admin', 'file_name' => 'configPrivacy', 'name' => 'Privacy', 'name_ar' => 'سياسية الاستخدام']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }
        if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
            $addLang = ['Branch' => ['id' => 'Branch', 'group' => 'admin', 'file_name' => 'configBranch', 'name' => 'Branch', 'name_ar' => 'الفروع']];
            $LangMenu = array_merge($LangMenu, $addLang);
        }

        return $LangMenu;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getDataTableLang($LangMenu, $AppLang) {
        $listFile = $LangMenu;
        $rowData = [];
        foreach ($AppLang as $key => $lang) {
            $rowData[$key] = [];
            if (isset($_GET['id']) and isset($listFile[$_GET['id']])) {
                $id = trim($_GET['id']);
                $prefixCopy = self::getPrefixCopy($listFile[$id]);
                $FullPathToFile = self::getFullPathToFileArr($listFile[$id], $key);
                $GetData = File::getRequire($FullPathToFile);
                $GetData[$key] = File::getRequire($FullPathToFile);
                foreach ($GetData[$key] as $keyVar => $tran) {
                    array_push($rowData[$key], ['filekey' => $id, "name_" . $key => $tran, 'keyVar' => $keyVar, 'prefixCopy' => $prefixCopy . $keyVar]);
                }
            } else {
                foreach ($listFile as $filekey => $fileVall) {
                    $prefixCopy = self::getPrefixCopy($listFile[$filekey]);
                    $FullPathToFile = self::getFullPathToFileArr($listFile[$filekey], $key);
                    $GetData[$key] = File::getRequire($FullPathToFile);
                    foreach ($GetData[$key] as $keyVar => $tran) {
                        array_push($rowData[$key], ['filekey' => $filekey, "name_" . $key => $tran, 'keyVar' => $keyVar, 'prefixCopy' => $prefixCopy . $keyVar]);
                    }
                }
            }
        }

        $countLoop = 0;
        foreach ($AppLang as $key => $lang) {
            $countLoop = intval($countLoop) + count($rowData[$key]);
        }

        $forloop = $countLoop / count($AppLang);
        $LastData = [];
        for ($i = 0; $i < $forloop; $i++) {
            $langloop = [];
            foreach ($AppLang as $key => $lang) {
                $langloop += $rowData[$key][$i] ?? [];
            }
            array_push($LastData, $langloop);
        }

        return $LastData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getPrefixCopy($row) {
        $line = "";
        if ($row['group'] != null) {
            $line .= $row['group'] . "/";
        }
        if (isset($row['sub_dir']) and $row['sub_dir'] != null) {
            $line .= $row['sub_dir'] . "/";
        }
        $line .= $row['file_name'] . ".";
        return $line;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getFullPathToFileArr($row, $key) {
        if ($row['group'] != null) {
            $groupFolder = $row['group'] . "/";
            $fullPath = resource_path("lang/$key/" . $row['group']);
            if (!File::isDirectory($fullPath)) {
                File::makeDirectory($fullPath, 0777, true, true);
            }
        } else {
            $groupFolder = "";
        }

        if (isset($row['sub_dir']) and $row['sub_dir'] != null) {
            $subDirFolder = $row['sub_dir'] . "/";

            $fullPathSubDir = resource_path("lang/$key/" . $row['group'] . "/" . $row['sub_dir']);
            if (!File::isDirectory($fullPathSubDir)) {
                File::makeDirectory($fullPathSubDir, 0777, true, true);
            }
        } else {
            $subDirFolder = "";
        }

        $saveFileName = $row['file_name'] . ".php";
        $fullPathFile = resource_path("lang/$key/" . $groupFolder . $subDirFolder . $saveFileName);

        if (!File::isFile($fullPathFile)) {
            $content = "<?php\n\nreturn\n[\n";
            $content .= "];";
            File::put($fullPathFile, $content);
        }
        return $fullPathFile;
    }

}
