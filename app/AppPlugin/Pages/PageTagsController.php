<?php

namespace App\AppPlugin\Pages;


use App\AppPlugin\Pages\Models\PageTags;
use App\AppPlugin\Pages\Models\PageTagsTranslation;
use App\AppPlugin\Pages\Traits\PageConfigTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefTagsRequest;

use App\Http\Traits\TagsTraits;
use Illuminate\Support\Facades\View;


class PageTagsController extends AdminMainController {

    use TagsTraits;
    use PageConfigTraits;


    function __construct() {

        parent::__construct();
        $this->controllerName = "PageTags";
        $this->PrefixRole = 'Pages';
        $this->selMenu = "admin.Pages.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/pages.app_menu_tags');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->tags = new PageTags();
        $this->tagsTranslation = new PageTagsTranslation();

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, "orderbyPostion" => 1],

        ];

        $this->config = self::LoadConfig();
        View::share('config', $this->config);
        self::ConstructData($sendArr);

        
        if (!$this->TableTags) {
            abort(403);
        }

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsStoreUpdate
    public function TagsStoreUpdate(DefTagsRequest $request, $id = 0) {
        return self::TraitsTagsStoreUpdate($request, $id);
    }

}