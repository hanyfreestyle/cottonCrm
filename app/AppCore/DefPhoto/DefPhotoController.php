<?php

namespace App\AppCore\DefPhoto;

use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use function NunoMaduro\Collision\Exceptions\getCode;

class DefPhotoController extends AdminMainController {
    function __construct(DefPhoto $model) {
        parent::__construct();
        $this->controllerName = "defPhoto";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/upFilter.app_menu_def_photo');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
        ];

        self::loadConstructData($sendArr);

        $permission = [
            'sub' => 'config_defPhoto_view',
            'edit' => ['sortDefPhotoList'],
        ];
        self::loadPagePermission($permission);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('DefPhotoList_Cash');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";

        $defPhoto = glob("Def/*");
        $rowData = DefPhoto::orderBy('position')->get();
        return view('admin.appCore.photo_def.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'defPhoto' => $defPhoto,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = DefPhoto::findOrNew(0);
        return view('admin.appCore.photo_def.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = DefPhoto::findOrFail($id);
        return view('admin.appCore.photo_def.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function storeUpdate(DefPhotoRequest $request, $id = '0') {

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload('2');
        $saveImgData->setUploadDirIs('def-photo');
        $saveImgData->setnewFileName($request->cat_id);
        $saveImgData->UploadOne($request);

        $saveData = DefPhoto::findOrNew($id);
        $saveData->cat_id = AdminHelper::Url_Slug($request->cat_id, ['delimiter' => '_']);

        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);

        $saveData->save();
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function destroy($id) {
        $deleteRow = DefPhoto::findOrFail($id);
        $deleteRow = AdminHelper::onlyDeletePhotos($deleteRow, 3);
        $deleteRow->delete();
        self::ClearCash();
        return redirect(route('admin.config.defPhoto.index'))->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function sortDefPhotoList() {
        $pageData = $this->pageData;
        $rowData = DefPhoto::orderBy('position')->paginate(50);
        $pageData['ViewType'] = "List";
        return view('admin.appCore.photo_def.indexSort', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function sortDefPhotoSave(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = DefPhoto::findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        Cache::forget('DefPhoto_Cash');
        return response()->json(['success' => $positions]);
    }

}
