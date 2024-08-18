<?php

namespace App\AppPlugin\Models\Faq;

use App\AppPlugin\Models\Faq\Models\FaqTags;
use App\AppPlugin\Models\Faq\Models\FaqTagsTranslation;
use App\AppPlugin\Models\Faq\Traits\FaqConfigTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefTagsRequest;

use App\Http\Traits\TagsTraits;
use Illuminate\Support\Facades\View;


class FaqTagsController extends AdminMainController {

    use TagsTraits;
    use FaqConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "FaqTags";
        $this->PrefixRole = 'Faq';
        $this->selMenu = "admin.Faq.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/faq.app_menu_tags');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->tags = new FaqTags();
        $this->tagsTranslation = new FaqTagsTranslation();

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
        ];

        $this->config = self::LoadConfig();
        View::share('config', $this->config);

        self::ConstructData($sendArr);
        self::loadPostPermission(array());

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
