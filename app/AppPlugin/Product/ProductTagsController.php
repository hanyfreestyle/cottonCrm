<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\ProductTags;
use App\AppPlugin\Product\Models\ProductTagsTranslation;
use App\AppPlugin\Product\Request\ProductTagsRequest;
use App\AppPlugin\Product\Traits\ProductConfigTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefTagsRequest;
use App\Http\Traits\TagsTraits;
use Illuminate\Support\Facades\View;


class ProductTagsController extends AdminMainController {

    use TagsTraits;
    use ProductConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "ProductTags";
        $this->PrefixRole = 'Product';
        $this->selMenu = "admin.Shop.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_tags');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $this->tags = new ProductTags();
        $this->tagsTranslation = new ProductTagsTranslation();

        $this->Config = self::LoadConfig();
        View::share('Config', $this->Config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0],
            'yajraTable' => false,
        ];
        self::loadConstructData($sendArr);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsStoreUpdate
    public function TagsStoreUpdate(DefTagsRequest $request, $id = 0) {
        return self::TraitsTagsStoreUpdate($request, $id);
    }

}
