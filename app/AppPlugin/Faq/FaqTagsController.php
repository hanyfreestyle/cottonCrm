<?php

namespace App\AppPlugin\Faq;

use App\AppPlugin\Faq\Models\FaqTags;
use App\AppPlugin\Faq\Models\FaqTagsTranslation;
use App\AppPlugin\Faq\Traits\FaqConfigTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefTagsRequest;
use App\Http\Traits\DbFunTraits;
use App\Http\Traits\TagsTraits;
use Illuminate\Support\Facades\View;


class FaqTagsController extends AdminMainController {

    use TagsTraits;
    use FaqConfigTraits;
    use DbFunTraits;

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
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, "orderbyPostion" => 1],
            'yajraTable' => true,
        ];

        $Config = self::LoadConfig();
        View::share('Config', $Config);


        self::loadConstructData($sendArr);

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
