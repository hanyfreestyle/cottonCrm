<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\LandingPage;
use App\AppPlugin\Product\Models\LandingPageTranslation;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Request\LandingPageRequest;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ProductLandingController extends AdminMainController {

    function __construct() {
        parent::__construct();
        $this->controllerName = "LandingPage";
        $this->PrefixRole = 'Pages';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/pages.app_menu_page');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ['datatable'=>0],
            'yajraTable' => false,
            'AddLang' => false,
            'AddMorePhoto' => false,
            'restore' => 0,
        ];

        $this->CashBrandList = self::CashBrandList($this->StopeCash);
        View::share('CashBrandList', $this->CashBrandList);

        $this->Products = Product::query()->where('parent_id', null)->with('translations')->get();
        View::share('Products', $this->Products);

        self::loadConstructData($sendArr);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $rowData = self::getSelectQuery(LandingPage::def());

        return view('AppPlugin.Product.landing.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $rowData = LandingPage::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selPro = [];
        return view('AppPlugin.Product.landing.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'LangAdd' => $LangAdd,
            'selPro' => $selPro,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PageEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $rowData = LandingPage::where('id', $id)->firstOrFail();
        $selPro = $rowData->product_id ;
        $LangAdd = self::getAddLangForEdit($rowData);

        return view('AppPlugin.Product.landing.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'LangAdd' => $LangAdd,
            'selPro' => $selPro,
        ]);

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function PageStoreUpdate(LandingPageRequest $request, $id = 0) {
        $saveData = LandingPage::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {

                $saveData->brand_id = $request->input('brand_id');
                $saveData->product_id = $request->input('product_id');
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->is_soft = intval((bool)$request->input('is_soft'));
                $saveData->save();

                self::SaveAndUpdateDefPhoto($saveData, $request, "lp", 'ar.name');

                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $CatId = "page_id";
                    $saveTranslation = LandingPageTranslation::where($CatId, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->page_id = $saveData->id;
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation->desup = $request->input($key . '.desup');
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function config() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        if($this->configView) {
            return view($this->configView, compact('pageData'));
        } else {
            return view("admin.mainView.config", compact('pageData'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     emptyPhoto
    public function emptyPhoto($id) {
        $rowData = LandingPage::where('id', $id)->firstOrFail();
        $rowData = AdminHelper::DeleteAllPhotos($rowData, true);
        $rowData->save();
        return back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function destroy($id) {
        $deleteRow = LandingPage::where('id', $id)->firstOrFail();
        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
        $deleteRow->forceDelete();
        return back()->with('confirmDelete', "");
    }


}
