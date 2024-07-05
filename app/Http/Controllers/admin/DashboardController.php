<?php

namespace App\Http\Controllers\admin;
use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\BlogPost\Models\BlogTagsTranslation;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\CategoryTranslation;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Helpers\PDF;
use Stichoza\GoogleTranslate\GoogleTranslate;


class DashboardController extends AdminMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function updateBrandLang() {

//        $Brands = BrandTranslation::where('des','!=',null)->where('g_des',null)->get();
//        foreach ($Brands as $brand){
//            $brand->g_des = AdminHelper::seoDesClean($brand->des);
//            $brand->save();
//
//        }

//        $Brands = BrandTranslation::where('g_title',null)->get();
//        foreach ($Brands as $brand){
//            $brand->g_title ="تعرف علي افضل أسعار ومميزات"." ".$brand->name." "." من موقع قطن ";
//            $brand->save();
//        }


//        $Categorys = Brand::with('translations')->get();
//        $tr = new GoogleTranslate('en');
//        foreach ($Categorys as $Category){
//            if($Category->translate('en') == null){
//                $name = $tr->translate($Category->name) ;
//
//                $saveTranslation = new BrandTranslation();
//                $saveTranslation->brand_id = $Category->id;
//                $saveTranslation->locale = 'en';
//                $saveTranslation->slug = AdminHelper::Url_Slug($name);
//                $saveTranslation->name = $name;
//                $saveTranslation->des = $Category->des;
//                $saveTranslation->g_title = $tr->translate($Category->g_title);
//                $saveTranslation->g_des = $tr->translate($Category->g_des);
//                $saveTranslation->save();
//            }
//        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function updateCatLang() {
        dd('hi');
        $Categorys = Category::with('translations')->get();
        $tr = new GoogleTranslate('en');
        foreach ($Categorys as $Category) {
            if ($Category->translate('en') == null) {
                $name = $tr->translate($Category->name);

                $saveTranslation = new CategoryTranslation();
                $saveTranslation->category_id = $Category->id;
                $saveTranslation->locale = 'en';
                $saveTranslation->slug = AdminHelper::Url_Slug($name);
                $saveTranslation->name = $name;
                $saveTranslation->des = $Category->des;
                $saveTranslation->g_title = $tr->translate($Category->g_title);
                $saveTranslation->g_des = $tr->translate($Category->g_des);
                $saveTranslation->save();
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   UpdateBlogLang
    public function UpdateBlogLang() {
//        dd('hi');
        $Categorys = Blog::with('translations')->get();
        $tr = new GoogleTranslate('en');
        foreach ($Categorys as $Category) {
            if ($Category->translate('en') == null) {
                $name = $tr->translate($Category->name);

                $saveTranslation = new BlogTranslation();
                $saveTranslation->blog_id = $Category->id;
                $saveTranslation->locale = 'en';
                $saveTranslation->slug = AdminHelper::Url_Slug($Category->id . " " . $name);
                $saveTranslation->name = $name;
                $saveTranslation->des = $name;
                $saveTranslation->g_title = $name;
                $saveTranslation->g_des = $name;
                $saveTranslation->save();
            }
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function UpdateTagLang() {
        dd('hi');
        $ids = ['27', '144', '148', '149', '150', '416', '419', '421', '422'];
        $ids = ['27', '144', '148', '149', '150', '416', '419', '421', '422'];
        $Categorys = BlogTags::with('translations')->get();
        $tr = new GoogleTranslate('en');
        foreach ($Categorys as $Category) {
            if ($Category->translate('en') == null) {
                $name = $tr->translate($Category->name);
                $saveTranslation = new BlogTagsTranslation();
                $saveTranslation->tag_id = $Category->id;
                $saveTranslation->locale = 'en';
                $saveTranslation->slug = AdminHelper::Url_Slug($Category->id . " " . $name);
                $saveTranslation->name = $name;
                $saveTranslation->save();
            }
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function adminTest() {
    }


    public function testpdf() {
        $pdf = new PDF();
        $data = [
            'foo' => 'bar'
        ];
        $pdf->addArCustomFont();
        $pdf->addEnCustomFont();
        $pdf->loadView('pdf.test', $data);
        //$pdf->SetProtection(['copy', 'print'], 'user_pass', 'owner_pass');
        return $pdf->stream('document.pdf');
        // return $pdf->download("hany.pdf");
    }





#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # Home
    public function Dashboard() {
        return view('admin.dashbord')->with([


        ]);
    }

}
