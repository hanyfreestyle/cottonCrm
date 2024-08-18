<?php

namespace App\AppPlugin\Faq;


use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Faq\Models\FaqCategory;
use App\AppPlugin\Faq\Models\FaqCategoryTranslation;
use App\AppPlugin\Faq\Traits\FaqConfigTraits;
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

        if (IsConfig($this->config, 'TableCategory')) {
            self::SetCatTree(IsConfig($this->config, 'categoryTree'), IsConfig($this->config, 'categoryDeep', 1));
        }
        View::share('config', $this->config);

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
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('ssssssss');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryStoreUpdate
    public function CategoryStoreUpdate(DefCategoryRequest $request, $id = 0) {
        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id) {
        $deleteRow = FaqCategory::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_faq')
            ->firstOrFail();

        if($deleteRow->del_category_count == 0 and $deleteRow->del_faq_count == 0) {
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

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {
        $Config = self::DbConfig();

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Faq";
        $mainMenu->name = "admin/faq.app_menu";
        $mainMenu->icon = "fas fa-question-circle";
        $mainMenu->roleView = "Faq_view";
        $mainMenu->save();

        if ($Config['TableCategory']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("FaqCategory");
            $subMenu->url = "admin.Faq.FaqCategory.index";
            $subMenu->name = "admin/faq.app_menu_category";
            $subMenu->roleView = "Faq_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("Question");
        $subMenu->url = "admin.Faq.Question.index";
        $subMenu->name = "admin/faq.app_menu_faq";
        $subMenu->roleView = "Faq_view";
        $subMenu->icon = "fas fa-question";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Question.createX";
        $subMenu->url = "admin.Faq.Question.create";
        $subMenu->name = "admin/faq.app_menu_add_faq";
        $subMenu->roleView = "Faq_view";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        if ($Config['TableTags']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "FaqTags.index|FaqTags.edit|FaqTags.create|FaqTags.config";
            $subMenu->url = "admin.Faq.FaqTags.index";
            $subMenu->name = "admin/faq.app_menu_tags";
            $subMenu->roleView = "Faq_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }


    }

}
