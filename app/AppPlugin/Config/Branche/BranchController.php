<?php

namespace App\AppPlugin\Config\Branche;

use App\Http\Controllers\AdminMainController;

use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends AdminMainController {
    use CrudTraits;

    function __construct(Branch $model) {

        parent::__construct();
        $this->controllerName = "Branch";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/configBranch.app_menu');
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
        $this->middleware('permission:config_branch', ['only' => ['index']]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = Branch::onlyTrashed()->count();

        $rowData = self::getSelectQuery(Branch::where('id', '!=', 0));
        return view('AppPlugin.ConfigBranch.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $rowData = self::getSelectQuery(Branch::onlyTrashed());
        return view('AppPlugin.ConfigBranch.index', compact('pageData', 'rowData'));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = new Branch();
        return view('AppPlugin.ConfigBranch.form', compact('rowData', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = Branch::findOrFail($id);
        return view('AppPlugin.ConfigBranch.form', compact('rowData', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function storeUpdate(BranchRequest $request, $id = '0') {
        try {
            DB::transaction(function () use ($request, $id) {

                $branch = Branch::findOrNew($id);
                $branch->is_active = intval((bool)$request->input('is_active'));
                $branch->lat = $request->input('lat');
                $branch->long = $request->input('long');
                $branch->direction = $request->input('direction');
                $branch->whatsapp = $request->input('whatsapp');
                $branch->save();

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = BranchTranslation::where('branch_id', $branch->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->branch_id = $branch->id;
                    $saveTranslation->locale = $key;
                    $saveTranslation->title = $request->input($key . '.title');
                    $saveTranslation->address = $request->input($key . '.address');
                    $saveTranslation->work_hours = $request->input($key . '.work_hours');
                    $saveTranslation->phone = $request->input($key . '.phone');
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
        $branches = Branch::query()->orderBy('postion')->get();
        return view('AppPlugin.ConfigBranch.sort', compact('pageData', 'branches'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SaveSort
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = Branch::findOrFail($id);
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        return response()->json(['success' => $positions]);
    }

}
