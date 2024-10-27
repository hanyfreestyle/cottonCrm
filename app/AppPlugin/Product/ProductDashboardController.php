<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\Orders\Models\Order;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;


class ProductDashboardController extends AdminMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function Dashboard(Request $request, $id = null) {

//        $product = Product::query()->where('parent_id', null)->pluck('is_archived');
//        $product_cat = Category::query()->count();
//        $product_barnd = Brand::query()->count();
//
//        $blog_count = Blog::query()->count();
//        $blog_cat_count = BlogCategory::query()->count();
//        $product_active = $product->where('is_archived', false)->count();
//        $product_archived = $product->where('is_archived', true)->count();
//
//        $orders = Order::query()->get();







        $card = [];
//        $card['product_count'] = $product_active;
//        $card['product_archived'] = $product_archived;
//        $card['product_cat'] = $product_cat;
//        $card['product_barnd'] = $product_barnd;
//        $card['blog_count'] = $blog_count;
//        $card['blog_cat_count'] = $blog_cat_count;
//        $card['order_count'] = $orders->count();
//        $card['order_sum'] = $orders->where('status','!=',4)->sum('total');
//        $card['order_state_1'] = $orders->where('status', 1)->count();
//        $card['order_state_2'] = $orders->where('status', 2)->count();
//        $card['order_state_3'] = $orders->where('status', 3)->count();
//        $card['order_state_4'] = $orders->where('status', 4)->count();

        return view('AppPlugin.Product.dashbord.index')->with([
            'card' => $card,
        ]);
    }


}
