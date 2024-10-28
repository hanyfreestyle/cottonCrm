<?php

namespace App\AppPlugin\Product;

use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\Attribute;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\ProductAttribute;
use App\AppPlugin\Product\Models\ProductPhoto;
use App\AppPlugin\Product\Models\ProductTranslation;
use App\AppPlugin\Product\Request\UpdateAttributeRequest;
use App\AppPlugin\Product\Request\UpdateVariantsRequest;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;

class ManageAttributeController extends AdminMainController {

    use CrudTraits;

    function __construct(Product $model, ProductTranslation $translation, ProductPhoto $modelPhoto) {
        parent::__construct();
        $this->controllerName = "Product";
        $this->PrefixRole = 'Product';
        $this->selMenu = "admin.Product.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/proProduct.app_menu_product');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;
        $this->modelPhoto = $modelPhoto;
        $this->modelPhotoColumn = 'product_id';

        $this->UploadDirIs = 'product';
        $this->translation = $translation;
        $this->translationdb = 'product_id';

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => 1, 'morePhotoFilterid' => 1],
            'yajraTable' => true,
            'AddLang' => true,
            'restore' => 1,
            'formName' => "ProductFilters",
        ];

        self::loadConstructData($sendArr);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function RemoveVariants($proId) {
        $product = Product::where('id', $proId)->with('childproduct')->firstOrFail();
        $productAttributes = ProductAttribute::where('product_id', $proId)->get();

        foreach ($productAttributes as $attribute) {
            $attribute->forceDelete();
        }
        foreach ($product->childproduct as $childproduct) {
            $childproduct->forceDelete();
        }
        return redirect()->back();
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    ManageAttribute
    public function ManageAttribute($proId) {


        $pageData = $this->pageData;
        $pageData['ViewType'] = "ManageAttribute";
        $product = Product::where('id', $proId)->with('attributes')->with('childproduct')->firstOrFail();
        $product_attributes = $product->attributes->pluck('id');
        $attributes = Attribute::whereNotIn('id', $product_attributes)->with('values')->get();


        $productAttr = ProductAttribute::where('product_id', $proId)->orderby('attribute_id')->with('attributeName')->get();

        $attributeValues = [];
        foreach ($productAttr as $key => $attr) {
            if($attr->values) {
                $thisAttrVaIds = json_decode($attr->values, true);
                $attributeValues[] = AttributeValue::whereIn('id', $thisAttrVaIds)->get();
            }
        }

        $attributeValues = $this->get_combinations($attributeValues);

        $attributeValue = AttributeValue::get()->keyBy('id')->toArray();


        return view('AppPlugin.Product.manage-attribute.index')->with([
            'pageData' => $pageData,
            'product' => $product,
            'attributes' => $attributes,
            'product_attributes' => $product_attributes,

            'attributeValues' => $attributeValues,
            'attributeValue' => $attributeValue,
            'productAttr' => $productAttr,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ManageAttributeUpdate
    public function ManageAttributeUpdate(Request $request, $proId) {
        $product = Product::where('id', $proId)->firstOrFail();
        $attributes = $request->input('attributes');
        $product->attributes()->attach($attributes);
        $product->save();
        return back()->with('data_not_save', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function RemoveAttribute($proId, $AttributeId) {
        $product = Product::where('id', $proId)->firstOrFail();
        $product->attributes()->detach($AttributeId);
        return back()->with('data_not_save', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ManageAttributeValueUpdate(UpdateAttributeRequest $request) {
        foreach ($request->input('ids') as $id) {
            $update = ProductAttribute::where('id', $id)->firstOrFail();
            $update->values = $request->attributes_values[$id] ?? '';
            $update->save();
        }
        return back()->with('data_not_save', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function get_combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = $result_item + array(uniqid() => $property_value->id);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     UpdateVariants
    public function UpdateVariants(UpdateVariantsRequest $request) {

        $product = Product::findOrFail($request->proId);
        $variantList = $request->input('product_variants');

        foreach ($variantList as $key => $list) {
            if($list['price'] > 0) {
                $data = [];
                sort($list['variants']);
                sort($list['variants_id']);
                $variants_slug_id = implode('-', $list['variants_id']);
                $variants_slug_id = "-" . $variants_slug_id . "-";

                $updateV = Product::where('parent_id', $product->id)->where('variants_slug_id', $variants_slug_id)->firstOrNew();
                $updateV->parent_id = $product->id;
                $updateV->variants_slug_id = $variants_slug_id;
                $updateV->price = $list['price'];
                $updateV->regular_price = $list['regular_price'];
                $updateV->save();
            }
        }
        return back()->withSuccess("Updated Successful.");
    }


    /*
     #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #    ManageAttribute
        public function ManageAttribute($proId) {


            $pageData = $this->pageData;
            $pageData['ViewType'] = "Edit";
            $product = Product::where('id', $proId)->with('attributes')->with('childproduct')->firstOrFail();

    //        dd($product->childproduct);

            $product_attributes = $product->attributes->pluck('id');
    //        dd($product_attributes);

    //dd($product->attributes->pivot);
            $attributeValues = [];
    foreach ($product->attributes as $one){
      // print_r($one->pivot);

        foreach (json_decode($one->pivot->values,true) as $key) {

            //if($one->pivot->values) {
               // $thisAttrVaIds = json_decode($attr->values, true);
               $attributeValues[] = AttributeValue::where('id',$key )->get();
            //}
        }
    }





            //dd(count($attributeValues));

            $attributes = Attribute::whereNotIn('id', $product_attributes)->with('values')->get();

            return view('AppPlugin.Product.manage-attribute', compact('pageData', 'product', 'attributes','product_attributes','attributeValues'));
        }


     */


}



