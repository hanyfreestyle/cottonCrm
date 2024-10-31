<?php


namespace App\AppPlugin\Product\Traits;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\Category;
use Illuminate\Support\Facades\Cache;

trait ProductConfigTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function LoadConfig() {
        $config = [
            'PrefixRole' => "Blog",

            'DbCategory' => 'pro_category',
            'DbCategoryTrans' => 'pro_category_lang',
            'DbCategoryPivot' => 'pro_category_pivot',
            'DbCategoryForeign' => 'category_id',

            "TableBrand" => true,
            'DbBrand' => 'pro_brand',
            'DbBrandTrans' => 'pro_brand_lang',

            "TableAttribute" => true,
            'DbAttribute' => 'pro_brand',
            'DbAttributeTrans' => 'pro_brand_lang',


            "TableLandingPage" => true,
            'DbLandingPage' => 'pro_landing_page',
            'DbLandingPageTrans' => 'pro_landing_page_lang',
            'DbLandingPageForeign' => 'page_id',

            'DbPost' => 'pro_product',
            'DbPostTrans' => 'pro_product_lang',
            'DbPostReview' => 'blog_post_review',
            'DbPostForeignId' => 'product_id',

            'DbPhoto' => 'pro_product_photos',
            'DbPhotoTrans' => 'blog_photo_lang',

            'DbTags' => 'pro_tags',
            'DbTagsTrans' => 'pro_tags_lang',
            'DbTagsPivot' => 'pro_tags_pivot',


            'LangCategoryDefName' => __('admin/def.category_name'),
            'LangCategoryDefDes' => __('admin/form.text_content'),
            'LangPostDefName' => __('admin/blogPost.blog_text_name'),
            'LangPostDefDes' => __('admin/form.text_content'),

        ];

        $defConfig = getConfigFromJson('model_product');
        $Config = array_merge($config, $defConfig);

        foreach ($Config as $key => $value) {
            $this->$key = $value;
        }
        return $Config;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function DbConfig() {
        $Config = new class {
            use ProductConfigTraits;
        };
        return $Config->LoadConfig();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashCategoriesList($stopCash = 0) {
        if ($stopCash) {
            $CashCategoriesList = Category::CashCategoriesList();
        } else {
            $CashCategoriesList = Cache::remember('CashCategoriesList', cashDay(7), function () {
                return Category::CashCategoriesList();
            });
        }
        return $CashCategoriesList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function CashAttributeValueList($stopCash = 0) {
        if ($stopCash) {
            $CashAttributeValueList = AttributeValue::all();
        } else {
            $CashAttributeValueList = Cache::remember('CashAttributeValueList', cashDay(7), function () {
                return AttributeValue::all();
            });
        }
        return $CashAttributeValueList;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function getAdminMenu() {
        $config = self::DbConfig();


        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.Product";
        $mainMenu->name = "admin/proProduct.app_menu";
        $mainMenu->icon = "fas fa-shopping-cart";
        $mainMenu->roleView = "Product_view";
        $mainMenu->position = 1;
        $mainMenu->save();

        if (IsConfig($config, 'TableCategory')) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("Category");
            $subMenu->url = "admin.Product.Category.index";
            $subMenu->name = "admin/proProduct.app_menu_category";
            $subMenu->roleView = "Product_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();
        }

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = setActiveRoute("ProductList")."|index.filter";
        $subMenu->url = "admin.Product.ProductList.index";
        $subMenu->name = "admin/proProduct.app_menu_product";
        $subMenu->roleView = "Product_view";
        $subMenu->icon = "fas fa-shopping-cart";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Product.createNew";
        $subMenu->url = "admin.Product.ProductList.create";
        $subMenu->name = "admin/proProduct.app_menu_add_pro";
        $subMenu->roleView = "Product_add";
        $subMenu->icon = "fas fa-plus-circle";
        $subMenu->save();

        if (IsConfig($config, 'TableBrand')) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("Brand");
            $subMenu->url = "admin.Product.Brand.index";
            $subMenu->name = "admin/proProduct.app_menu_brand";
            $subMenu->roleView = "Product_view";
            $subMenu->icon = "fas fa-copyright";
            $subMenu->save();
        }

        if (IsConfig($config, 'TableTags')) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("ProductTags");
            $subMenu->url = "admin.Product.ProductTags.index";
            $subMenu->name = "admin/proProduct.app_menu_tags";
            $subMenu->roleView = "Product_view";
            $subMenu->icon = "fas fa-hashtag";
            $subMenu->save();
        }


        if (IsConfig($config, 'TableAttribute')) {
            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("ProAttribute") . "|" . setActiveRoute("ProAttributeValue");
            $subMenu->url = "admin.Product.ProAttribute.index";
            $subMenu->name = "admin/proProduct.app_menu_attribute";
            $subMenu->roleView = "Product_view";
            $subMenu->icon = "fas fa-code-branch";
            $subMenu->save();
        }


        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Archived";
        $subMenu->url = "admin.Product.ProductList.Archived";
        $subMenu->name = "admin/proProduct.app_menu_archived_products";
        $subMenu->roleView = "Product_view";
        $subMenu->icon = "fas fa-archive";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UpdatePrices.index";
        $subMenu->url = "admin.Product.UpdatePrices.index";
        $subMenu->name = "admin/proProduct.app_menu_update_price";
        $subMenu->roleView = "Product_edit";
        $subMenu->icon = "fas fa-hand-holding-usd";
        $subMenu->save();


        if (IsConfig($config, 'TableLandingPage')) {

            $mainMenu = new AdminMenu();
            $mainMenu->type = "Many";
            $mainMenu->sel_routs = "admin.LandingPage";
            $mainMenu->name = "admin/proProduct.app_menu_lp_page";
            $mainMenu->icon = "fab fa-html5";
            $mainMenu->roleView = "Product_view";
            $mainMenu->position = 1;
            $mainMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = setActiveRoute("LandingPage");
            $subMenu->url = "admin.LandingPage.index";
            $subMenu->name = "admin/proProduct.app_menu_lp_page_list";
            $subMenu->roleView = "Product_view";
            $subMenu->icon = "fas fa-sitemap";
            $subMenu->save();

            $subMenu = new AdminMenu();
            $subMenu->parent_id = $mainMenu->id;
            $subMenu->sel_routs = 'LandingPage.AddNew';
            $subMenu->url = "admin.LandingPage.AddNew";
            $subMenu->name = "admin/proProduct.app_menu_lp_page_add";
            $subMenu->roleView = "Product_view";
            $subMenu->icon = "fas fa-plus-circle";
            $subMenu->save();
        }


    }

}
