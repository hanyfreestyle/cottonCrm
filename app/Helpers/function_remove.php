<?php
use App\Http\Controllers\WebMainController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('IsMenuView')) {
    function IsMenuView($Arr, $Name, $fileName = null, $DefVall = true) {
        if ($fileName != null) {
            $filePath = base_path('routes/AppPlugin/' . $fileName);

            if (!file_exists($filePath)) {
                $DefVall = false;
            }
        }
        if (isset($Arr[$Name])) {
            $SendVal = $Arr[$Name];
        } else {
            $SendVal = $DefVall;
        }
        return $SendVal;
    }
}
if (!function_exists('getRoleName')) {
    function getRoleName() {
        if (thisCurrentLocale() == 'ar') {
            $sendName = "name_ar";
        } else {
            $sendName = "name_en";
        }
        return $sendName;
    }
}
if (!function_exists('printLang')) {
    function printLang($sendLang) {
        $sendLang = str_replace("&amp;lt;br&amp;gt;", "\n", $sendLang);
        return nl2br($sendLang);
    }
}
if (!function_exists('printLableKey')) {
    function printLableKey($key) {
        if (count(config('app.web_lang')) > 1) {
            $send = '(' . $key . ')';
        } else {
            $send = "";
        }
        return $send;
    }
}
if (!function_exists('DefCategoryTextName')) {
    function DefCategoryTextName($key) {
        if ($key) {
            $send = $key;
        } else {
            $send = __('admin/def.category_name');
        }
        return $send;
    }
}
if (!function_exists('isSetKeyForLang')) {
    function isSetKeyForLang($key) {
        if (isset($_GET['key']) and $_GET['key'] == $key) {
            return "ThisSelectLang";
        } else {
            return '';
        }

    }
}

if (!function_exists('printCategoryName')) {
    function printCategoryName($key, $row, $url) {

        if ($row->children_count > 0) {
            if (isset($row->translate($key)->name)) {
                return '<a href="' . route($url, $row->id) . '">' . $row->translate($key)->name . ' (' . $row->children_count . ')</a>';
            } else {
                return null;
            }
        } else {
            return $row->translate($key)->name ?? '';
        }
    }
}
if (!function_exists('ReportBlockPrint')) {
    function ReportBlockPrint($Col, $Titel, $Vall, $Icon = "", $Color = "bg-danger") {
        echo '<div class="' . $Col . ' report_widget">';
        echo '<div class="panel widget">';
        echo '<div class="row row-table row-flush">';
        if ($Icon) {
            echo '<div class="col-xs-4 ' . $Color . ' text-center">';
            echo '<em class="fa ' . $Icon . ' fa-2x"></em>';
            echo '</div>';
            $textCol = 'col-xs-8';
        } else {
            $textCol = 'col-xs-12';
        }
        echo '<div class="' . $textCol . '">';
        echo '<div class="panel-body text-center">';
        echo '<h4 class="mt0">' . $Vall . '</h4>';
        echo '<p class="mb0 text-muted">' . $Titel . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
if (!function_exists('GetChartVallFromArr_2022')) {
    function GetChartVallFromArr_2022($OldArr, $KeyFilter, $NameTabel_Arr, $SendArr = array()) {

        $findValueKey = issetArr($SendArr, "findValueKey", "id");
        $NamePrint = 'name';
        if (array_key_exists($KeyFilter, $OldArr[0])) {
            $OldArrAfterFilter = assc_array_count_values($OldArr, $KeyFilter);
            $EndArr = array();
            foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
                if ($Item_ID == '0') {
                    $NewVall = array('name' => "لا يوجد", 'count' => $Item_Count, 'id' => $Item_ID);
                } else {
                    $NewVall = array('name' => findValue_FromArr($NameTabel_Arr, $findValueKey, $Item_ID, $NamePrint), 'count' => $Item_Count, 'id' => $Item_ID);
                }
                array_push($EndArr, $NewVall);
            }
            $EndArr = array_sort($EndArr, 'count', SORT_DESC);
        }
        return $EndArr;
    }
}
if (!function_exists('findValue_FromArr')) {
    function findValue_FromArr($OldData, $Key, $Val, $SendName) {
        if (count($OldData) > 0 and intval($Val) > '0') {
            $hany = findValue($OldData, array($Key => $Val), "0");
            if (!empty($hany)) {
                $SendVall = $hany['0'][$SendName];
            } else {
                $SendVall = "";
            }
        } else {
            $SendVall = "";
        }
        return $SendVall;
    }
}
if (!function_exists('findValue')) {
    function findValue(array $array, array $parameters, $multipleResoult = false) {
        $result = array();//used when $multipleResoult == true
        $suspicious = false;
        foreach ($array as $childArray) {
            foreach ($parameters as $k => $p) {
                if (array_key_exists($k, $childArray)) {
                    if ($childArray[$k] == $p) {
                        $suspicious = $childArray;
                    } else {
                        $suspicious = false;
                        continue 2;
                    }
                } else {
                    $suspicious = false;
                    continue 2;
                }
            }
            if (is_array($suspicious)) {
                $result[] = $suspicious;
                if ($multipleResoult == true) {
                    $suspicious = false;
                } else {
                    break;
                }
            }
        }
        return $result;
    }
}
if (!function_exists('htmlLangInfo')) {
    function htmlLangInfo($getVall = "all") {
        $current = LaravelLocalization::getCurrentLocale();
        if ($current == 'ar') {

        } elseif ($current == 'en') {

        } else {

        }

        $data = [

        ];


        return $data;
    }
}


if (!function_exists('productSlugForCart')) {
    function productSlugForCart($product) {
        $slug = "#";
        if ($product->model->parent_id == null) {
            $slug = route('ProductView', $product->model->slug);
        } else {
            $slug = route('ProductView', $product->model->mainPro->slug);
        }
        return $slug;
    }
}

if (!function_exists('productPhotoForCart')) {
    function productPhotoForCart($product) {

        if ($product->model->parent_id == null) {
            $photo = getPhotoPath($product->model->photo_thum_1, "product", "photo");
        } else {
            $photo = getPhotoPath($product->model->mainPro->photo_thum_1, "product", "photo");
        }
        return $photo;
    }
}

if (!function_exists('cleanDes')) {
    function cleanDes($string) {
//            $text = preg_replace('#\s*\[caption[^]]*\].*?\[/caption\]\s*#is', '', $brand->des)
//            $string = preg_replace('/\[caption[^]]+]\R?/', '', $string);
//            $string = str_replace('[/caption]', '', $string);
//            $string = preg_replace('#\s*\[caption[^]]*\].*?\[/caption\]\s*#is', '', $string);

//            $pattern = '/.*(<img[^>]+)>.*/';
//            $remplacement = '$1';
//            $string =  preg_replace($pattern, $remplacement, $string);
//            $string = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $string);

        return $string;
    }
}

if (!function_exists('htmlBodyStyle')) {
    function htmlBodyStyle($pageView) {
        $current = LaravelLocalization::getCurrentLocale();
        if ($current == 'ar') {
            $dir = ' rtl ';
        } else {
            $dir = ' ltr ';
        }
        $value = issetArr($pageView, "page", '404');
        switch ($value) {

            case 'page_index':
                $sendStyle = " lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-index cart_pos_side kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_sticky_true des_header_3 h_banner_true top_bar_true prs_bordered_grid_1 search_pos_full lazyload ";
                break;

            case 'BlogPostList':
                $sendStyle = ' header_full_true kalles-template css_scrollbar lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true header_sticky_true hide_scrolld_true des_header_3 h_banner_true top_bar_true prs_bordered_grid_1 search_pos_canvas lazyload';
                break;

            case 'SinglePost':
                $sendStyle = ' kalles-template single-product-template zoom_tp_2 des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';
                $sendStyle = ' kalles-template single-product-template zoom_tp_2 des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';
                $sendStyle = '';
                break;
            case 'BrandView':
                $sendStyle = 'kalles-template single-product-template zoom_tp_2 header_full_true des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';
                $sendStyle = '';
                break;

            case 'Hany':
                $sendStyle = 'kalles-template single-product-template zoom_tp_2 header_full_true des_header_3 css_scrollbar lazy_icons btnt4_style_2 css_scrollbar template-index kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded wrapper_full_width header_full_true hide_scrolld_true lazyload';;
                break;


            case 'cart_page':
                $sendStyle = 'des_header_3 css_scrollbar lazy_icons btnt4_style_2 zoom_tp_2 css_scrollbar template-cart kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rounded hide_scrolld_true lazyload';
                break;


            default:
                $sendStyle = "";
        }


        return $dir . "label_style_rounded " . $sendStyle;
    }


}

?>
