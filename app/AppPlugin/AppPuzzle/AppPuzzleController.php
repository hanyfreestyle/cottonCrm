<?php

namespace App\AppPlugin\AppPuzzle;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


class AppPuzzleController extends AppPuzzleFun {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function IndexPuzzle() {
        $selRoute = null;

        $this->appPuzzle = new AppPuzzleController();
        View::share('appPuzzle', $this->appPuzzle);

        if (config('app.puzzle_active') == false) {
            return abort(403);
        }

        if (Route::currentRouteName() == 'admin.AppPuzzle.Config.IndexModel') {
            $rowData = AppPuzzleTreeConfig::tree();
            $selRoute = "Config";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Data.IndexModel') {
            $rowData = AppPuzzleTreeData::tree();
            $selRoute = "Data";

        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Model.IndexModel') {
            $rowData = AppPuzzleTreeModel::tree();
            $selRoute = "Model";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Product.IndexModel') {
            $rowData = AppPuzzleTreeProduct::tree();
            $selRoute = "Product";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Crm.IndexModel') {
            $rowData = AppPuzzleTreeCrm::tree();
            $selRoute = "Crm";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.CrmHoover.IndexModel') {
            $rowData = AppPuzzleTreeCrmHoover::tree();
            $selRoute = "CrmHoover";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Periodicals.IndexModel') {
            $rowData = AppPuzzleTreePeriodicals::tree();
            $selRoute = "Periodicals";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Client.IndexModel') {
            $selRoute = "Client";
            $rowData = ClientAppPuzzleTree::tree();
//            dd($rowData);
            return view('AppPlugin.AppPuzzle.index_client')->with([
                'rowData' => $rowData,
                'selRoute' => $selRoute,
            ]);


        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Tools.IndexModel') {
            $rowData = AppPuzzleTreeTools::tree();
            $selRoute = "Tools";

        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.AppCore.IndexModel') {
            $rowData = AppPuzzleTreeAppCore::AppCore();
            $selRoute = "AppCore";
            return view('AppPlugin.AppPuzzle.index_core')->with([
                'rowData' => $rowData,
                'selRoute' => $selRoute,
            ]);


        }

        return view('AppPlugin.AppPuzzle.index_model')->with([
            'rowData' => $rowData,
            'selRoute' => $selRoute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function LoadTreeData() {
        $Config = AppPuzzleTreeConfig::tree();
        $Model = AppPuzzleTreeModel::tree();
        $Data = AppPuzzleTreeData::tree();

        $Product = AppPuzzleTreeProduct::tree();
        $Crm = AppPuzzleTreeCrm::tree();
        $CrmHoover = AppPuzzleTreeCrmHoover::tree();
        $Periodicals = AppPuzzleTreePeriodicals::tree();
        $AppCore = AppPuzzleTreeAppCore::AppCore();
        $Tools = AppPuzzleTreeTools::tree();

        $treeData = $Config + $Model + $Data + $Product + $Crm + $AppCore + $Periodicals + $Tools + $CrmHoover;

        return $treeData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CopyModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $copy = new AppPuzzleFunCopy();

            $copy->copyAppFolder($thisModel);
            $copy->copyViewFolder($thisModel);
            $copy->copyRouteFile($thisModel);
            $copy->copyMigrations($thisModel);
            $copy->copyLangFile($thisModel);
            $copy->copyPhotoFolder($thisModel);
            $copy->copyAssetsFolder($thisModel);
            $copy->copyComponentFolder($thisModel);
            $copy->copyComponentFile($thisModel);
            $copy->copyLivewireFile($thisModel);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function RemoveModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $remove = new AppPuzzleFunRemove();

            $remove->removeAppFolder($thisModel);
            $remove->removeViewFolder($thisModel);
            $remove->removeRouteFile($thisModel);
            $remove->removeMigrations($thisModel);
            $remove->removeLangFiles($thisModel);
            $remove->removePhotoFolder($thisModel);
            $remove->removeAssetsFolder($thisModel);
            $remove->removeComponentFolder($thisModel);
            $remove->removeComponentFile($thisModel);
            $remove->removeLivewireFile($thisModel);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ImportModel($model) {
        $modelTree = self::LoadTreeData();
        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];
            $destinationFolder = base_path();
            if (File::isDirectory($BackFolder)) {
                self::recursive_files_copy($BackFolder, $destinationFolder);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ImportClientData($model) {
        $modelTree = ClientAppPuzzleTree::tree();
        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];
            $destinationFolder = base_path();
            if (File::isDirectory($BackFolder)) {
                self::recursive_files_copy($BackFolder, $destinationFolder);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function RemoveClientData($model) {
        $modelTree = ClientAppPuzzleTree::tree();
        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $FolderList = $thisModel['FolderList'];
            foreach ($FolderList as $folder) {
                if (File::isDirectory($folder)) {
                    File::deleteDirectory($folder);
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ExportClientData($model) {
        $modelTree = ClientAppPuzzleTree::tree();


        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $folderName = $thisModel['folderName'];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];


            $FolderList = $thisModel['FolderList'];
            foreach ($FolderList as $key => $value) {

                if ($key == 'db') {
                    $destinationFolder = $BackFolder . "/public/db/" . $folderName;
                } elseif ($key == 'config') {
                    $destinationFolder = $BackFolder . "/config_" . $folderName;
                } elseif ($key == 'adminLogo') {
                    $destinationFolder = $BackFolder . "/public/assets/admin/client/" . $folderName;
                } else {
                    $destinationFolder = null;
                }
                if (File::isDirectory($value)) {
                    self::recursive_files_copy($value, $destinationFolder);
                }
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


}
