<?php

namespace App\AppPlugin\Config\SiteMap;


use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class SiteMapController extends AdminMainController {
    use SiteMapModelTraits;

    function __construct() {

        parent::__construct();
        $this->controllerName = "SiteMap";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = 'Site Maps';
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddButToCard' => false,
        ];

        $this->config = [
            'singlePage' => true,
            'addAlternate' => true,
            'addPhoto' => true,
            'langAr' => true,
            'langEn' => false,
        ];
        View::share('Config', $this->config);
        self::loadConstructData($sendArr);

        $permission = [
            'sub' => 'sitemap_view',
            'view' => ['index', 'Robots', 'GoogleCode'],
            'edit' => ['UpdateSiteMap','RobotsUpdate','GoogleCodeUpdate'],
        ];
        self::loadPagePermission($permission);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $rowData = SiteMap::get();
        return view('AppPlugin.ConfigSiteMap.index')->with([
            'rowData' => $rowData,
            'pageData' => $pageData
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Robots() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $googleCode = GoogleCode::query()->first();

        return view('AppPlugin.ConfigSiteMap.robots')->with([
            'pageData' => $pageData,
            'googleCode' => $googleCode,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function RobotsUpdate(Request $request) {
        $googleCode = GoogleCode::query()->first();
        $googleCode->robots = $request->input('robots');
        $googleCode->save();
        return back()->with('Update.Done', '');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function GoogleCode() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $googleCode = GoogleCode::query()->first();

        return view('AppPlugin.ConfigSiteMap.google-code')->with([
            'pageData' => $pageData,
            'googleCode' => $googleCode,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function GoogleCodeUpdate(Request $request) {
        $googleCode = GoogleCode::query()->first();
        $googleCode->tag_manager_code = $request->input('tag_manager_code');
        $googleCode->analytics_code = $request->input('analytics_code');
        $googleCode->web_master_html = $request->input('web_master_html');
        $googleCode->web_master_meta = $request->input('web_master_meta');
        $googleCode->google_api = $request->input('google_api');
        $googleCode->save();
        return back()->with('Update.Done', '');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateSiteMap() {
        SiteMap::query()->truncate();
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', false);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);

        if ($this->config['singlePage']) {
            $xmlFileName = public_path('sitemap.xml');
            $fh = fopen($xmlFileName, 'w') or die("can't open file");
            $stringData = $siteMapTools->XML_HeaderSinglePage();
        } else {
            $stringData = "";
        }

        $addRoute = ['web_contact_us', 'web_about_us'];
        $stringData .= self::UpdateIndexPages('index', ['addRoute' => $addRoute]);
//        $stringData .= self::UpdateBlogPages('blog');
//        $stringData .= self::UpdateProductsPages('product');

        if ($this->config['singlePage']) {
            $stringData .= "</urlset>\n";
            fwrite($fh, $stringData);
            fclose($fh);
        }

        SiteMapTools::updateIndexSiteMapXmlFile($this->config['singlePage']);
        return back()->with('Update.Done', '');
    }

}
















