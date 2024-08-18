<?php

namespace App\AppPlugin\Models\BlogPost;

use App\AppPlugin\Models\BlogPost\Models\BlogCategory;
use App\AppPlugin\Models\BlogPost\Models\BlogCategoryTranslation;
use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Models\BlogPost\Traits\BlogConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefCategoryRequest;
use App\Http\Traits\CrudTraits;
use App\Http\Traits\CategoryTraits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class BlogCategoryController extends AdminMainController {

    use CrudTraits;
    use CategoryTraits;
    use BlogConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogCategory";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_category');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = new BlogCategory();
        $this->translation = new BlogCategoryTranslation();
        $this->UploadDirIs = 'blog-category';
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
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
//        Cache::forget('CashSideBlogCategories');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CategoryStoreUpdate
    public function CategoryStoreUpdate(DefCategoryRequest $request, $id = 0) {
        return self::TraitsCategoryStoreUpdate($request, $id);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroyException
    public function destroyException($id) {
        if ($this->categoryDelete == false) {
            abort(403);
        }

        $deleteRow = BlogCategory::where('id', $id)
            ->withCount('del_category')
            ->withCount('del_blog')
            ->firstOrFail();

        if ($deleteRow->del_category_count == 0 and $deleteRow->del_blog_count == 0) {
            try {
                DB::transaction(function () use ($deleteRow, $id) {
                    $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
                    AdminHelper::DeleteDir($this->UploadDirIs, $id);
                    $deleteRow->forceDelete();
                });
            } catch (\Exception $exception) {
                return back()->with(['confirmException' => '', 'fromModel' => 'CategoryBlog', 'deleteRow' => $deleteRow]);
            }
        } else {
            return back()->with(['confirmException' => '', 'fromModel' => 'CategoryBlog', 'deleteRow' => $deleteRow]);
        }
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    static function AdminMenu() {
        $Config = self::DbConfig();

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Blog";
        $mainMenu->name = "admin/blogPost.app_menu";
        $mainMenu->icon = "fab fa-blogger";
        $mainMenu->roleView = "Blog_view";
        $mainMenu->save();

        if ($Config['TableCategory']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("BlogCategory");
            $subMenu->url = "admin.Blog.BlogCategory.index";
            $subMenu->name = "admin/blogPost.app_menu_category";
            $subMenu->roleView = "Blog_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BlogPost.index|BlogPost.edit|BlogPost.editEn|BlogPost.editAr";
        $subMenu->url = "admin.Blog.BlogPost.index";
        $subMenu->name = "admin/blogPost.app_menu_blog";
        $subMenu->roleView = "Blog_view";
        $subMenu->icon = "fas fa-rss";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "BlogPost.create";
        $subMenu->url = "admin.Blog.BlogPost.create";
        $subMenu->name = "admin/blogPost.app_menu_add_blog";
        $subMenu->roleView = "Blog_view";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();


        if ($Config['TableTags']) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = "BlogTags.index|BlogTags.edit|BlogTags.create|BlogTags.config";
            $subMenu->url = "admin.Blog.BlogTags.index";
            $subMenu->name = "admin/blogPost.app_menu_tags";
            $subMenu->roleView = "Blog_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }

    }

}
