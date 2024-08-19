<?php

namespace App\AppPlugin\Models\Faq;


use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Models\Faq\Models\FaqCategory;
use App\AppPlugin\Models\Faq\Models\FaqCategoryTranslation;
use App\AppPlugin\Models\Faq\Traits\FaqConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefCategoryRequest;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class FaqCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits;
    use FaqConfigTraits;

    function __construct() {

        parent::__construct();
        $this->controllerName = "FaqCategory";
        $this->PrefixRole = 'Faq';
        $this->selMenu = "admin.Faq.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/faq.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new FaqCategory();
        $this->translation = new FaqCategoryTranslation();
        $this->UploadDirIs = 'faq-cat';
        $this->translationdb = 'category_id';

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        if (IsConfig($this->config, 'TableCategory')) {
            self::SetCatTree(IsConfig($this->config, 'categoryTree'), IsConfig($this->config, 'categoryDeep', 1));
        }


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'settings' => getDefSettings($this->config),
            'AddLang' => IsConfig($this->config, 'categoryAddOnlyLang', false),
        ];
        self::constructData($sendArr);
        self::loadCategoryPermission(array());
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ClearCash() {
        Cache::forget('ssssssss');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function CategoryStoreUpdate(DefCategoryRequest $request, $id = 0) {
        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function destroyException($id) {
        $deleteRow = FaqCategory::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_faq')
            ->firstOrFail();

        if ($deleteRow->del_category_count == 0 and $deleteRow->del_faq_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'CategoryFaq', 'deleteRow' => $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'CategoryFaq', 'deleteRow' => $deleteRow]);
        }

        self::ClearCash();
        return back()->with('confirmDelete', "");
    }



}
