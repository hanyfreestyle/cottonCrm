<?php

namespace App\AppPlugin\Product\Helpers;

use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\View;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

class LoadProductInfo {

    public $quickView;
    public $quickShop;


    public function __construct(
        $quickView = true,
        $quickShop = true,

    ) {
        $this->quickView = $quickView;
        $this->quickShop = $quickShop;
        $this->WebConfig = WebMainController::getWebConfig(0);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setQuickView
    public function setQuickView($quickView) {
        $this->quickView = $quickView;
        return $this;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setquickShop
    public function setquickShop($quickShop) {
        $this->quickShop = $quickShop;
        return $this;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function getInfo($product) {

        $proInfo['quickView'] = $this->quickView;
        $proInfo['quickShop'] = $this->quickShop;

        $proInfo['onsale'] = "";
        $proInfo['short_des'] = "";

        if($product->on_stock == true) {
            if($product->regular_price) {
                $discount = $product->regular_price - $product->price;
                $discount = ($discount / $product->regular_price) * 100;
                $discount = round($discount);

                $proInfo['onsale'] = '<div class="tc nt_labels pa pe_none cw"><span class="onsale nt_label"><span>' . $discount . '%</span></span></div>';
                $proInfo['price'] = '<div class="mb__5 print_price">';
                $proInfo['price'] .= '<div class="del"><span>' . __('web/product.label_currency') . '</span>' . number_format($product->regular_price, 0) . '</div>';
                $proInfo['price'] .= '<div class="ins"><span>' . __('web/product.label_currency') . "</span>" . number_format($product->price, 0) . '</div>';
                $proInfo['price'] .= '</div>';

            } else {
                $proInfo['onsale'] = '';
                $proInfo['price'] = '<div class="mb__5 print_price">';
                $proInfo['price'] .= '<div class="ins"><span>' . __('web/product.label_currency') . "</span>" . number_format($product->price, 0) . '</div>';
                $proInfo['price'] .= '</div>';
            }


        } else {
            $proInfo['quickShop'] = false;
            $proInfo['price'] = '<div class="mb__5 print_price">' . __('web/product.label_out_of_stock') . '</div>';
        }

        if($product->short_des != null) {
            $proInfo['short_des'] = $product->short_des;
        } else {
            $proInfo['short_des'] = AdminHelper::seoDesClean($product->des, '300');
        }

        if($this->WebConfig->pro_sale_lable == false) {
            $proInfo['onsale'] = "";
        }

        return $proInfo;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   getProductStyle
    public function getProductStyle() {
        $productStyle = [];
        $cardType = 2;
        $cropName = 1;
        $round = 1;

        if($round == 1) {
            $round = "desgin__2";
        } else {
            $round = "desgin__1";
        }
        if($cropName == 1) {
            $cropName = " crop_line_1";
        } else {
            $cropName = "";
        }


        if($cardType == 1) {
            $proStyle['cardStyleHolder'] = "on_list_view_false products nt_products_holder row row_pr_1 cdt_des_1 round_cd_false nt_cover ratio_nt position_8 space_30 nt_default";
            $proStyle['cardStyleRow'] = "pr_animated done mt__10 pr_grid_item product nt_pr $round tc";
            $proStyle['cardNameCrop'] = $cropName;
        } else {
            $proStyle['cardStyleHolder'] = "products nt_products_holder row row_pr_2 cdt_des_1 round_cd_false nt_cover ratio1_1 position_8 space_30 equal_nt";
            $proStyle['cardStyleRow'] = "pr_animated done mt__10 pr_grid_item product nt_pr $round tc";
            $proStyle['cardNameCrop'] = $cropName;
        }

        View::share('proStyle', $proStyle);

    }

}