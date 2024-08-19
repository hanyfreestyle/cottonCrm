<?php

namespace App\AppPlugin\Config\Apps;

use App\AppPlugin\Config\Apps\Models\AppMenu;
use App\AppPlugin\Config\Apps\Models\AppMenuTranslation;
use App\AppPlugin\Config\Apps\Request\AppMenuRequest;
use App\Http\Controllers\AdminMainController;


use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppMenuController extends AdminMainController {
    use CrudTraits;

    function __construct(AppMenu $model) {

        parent::__construct();
        $this->controllerName = "AppMenu";
        $this->PrefixRole = 'AppSetting';
        $this->selMenu = "admin.App.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/configApp.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["orderbyPostion" => 1, "filterid" => 0,],
            'restore' => 1,
        ];
        self::loadConstructData($sendArr);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = AppMenu::onlyTrashed()->count();

        $rowData = self::getSelectQuery(AppMenu::where('type', 'side'));
        return view('AppPlugin.ConfigApp.menu_index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $rowData = self::getSelectQuery(AppMenu::where('type', 'side')->onlyTrashed());
        return view('AppPlugin.ConfigApp.menu_index', compact('pageData', 'rowData'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $menu = new AppMenu();
        return view('AppPlugin.ConfigApp.menu_form', compact('menu', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $menu = AppMenu::where('type', 'side')->findOrFail($id);
        return view('AppPlugin.ConfigApp.menu_form', compact('menu', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function storeUpdate(AppMenuRequest $request, $id = '0') {
        try {
            DB::transaction(function () use ($request, $id) {

                $menu = AppMenu::findOrFail($id);
                $menu->is_active = intval((bool)$request->input('is_active'));
                $menu->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = AppMenuTranslation::where('menu_id', $menu->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->menu_id = $menu->id;
                    $saveTranslation->locale = $key;
                    $saveTranslation->url = urldecode($request->input($key . '.url'));
                    $saveTranslation->label = $request->input($key . '.label');
                    $saveTranslation->icon = $request->input($key . '.icon');
                    $saveTranslation->save();
                }

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Sort
    public function Sort() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $rowData = AppMenu::where('type', 'side')->orderBy('position')->get();
        return view('AppPlugin.ConfigApp.menu_sort', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SaveSort
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = AppMenu::findOrFail($id);
            $saveData->position = $newPosition;
            $saveData->save();
        }
        return response()->json(['success' => $positions]);
    }

}
