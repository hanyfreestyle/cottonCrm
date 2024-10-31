@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.product.form-top-icon :page-data="$pageData" :row="$rowData" web-slug="#"/>

    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <x-admin.form.print-error-div :full-err="false"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>

        <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="config" value="{{json_encode($config)}}">
            <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
            @csrf
            <div class="row mb-5">
                <div class="col-lg-9">
                    <div class="row">
                        @if($config['TableCategory'])
                            <x-admin.form.select-multiple name="categories" :categories="$Categories" :sel-cat="$selCat" :col="9"/>
                        @endif

                        @if($config['TableBrand'])
                            <x-admin.form.select-arr name="brand_id" sendvalue="{{old('brand_id',$rowData->brand_id)}}" :required-span="false"
                                                     :send-arr="$CashBrandList" label="{{__('admin/proProduct.app_menu_brand')}}" col="3"/>
                        @endif
                    </div>
                    <div class="row">
                        <x-admin.product.form-price :row="$rowData" :viewtype="$pageData['ViewType']"/>
                    </div>
                    @if($config['TableTags'])
                        <div class="row">
                            <x-admin.form.select-multiple name="tag_id" :categories="$tags" :sel-cat="$selTags" col="12"
                                                          :label="__('admin/proProduct.pro_text_tags')"/>
                        </div>
                    @endif
                    <hr>
                    <div class="row mt-2">
                        <x-admin.product.form-content :lang-send="$LangAdd" :row="$rowData" :viewtype="$pageData['ViewType']"/>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <x-admin.form.submit-role-back :page-data="$pageData"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <x-admin.product.status :row="$rowData" :viewtype="$pageData['ViewType']"/>

                    <x-admin.card.normal>
                        <div class="row">
                            <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" :labelview="false" col="12"/>
                        </div>
                    </x-admin.card.normal>

                    @if($pageData['ViewType'] == 'Edit' and count($rowData->childproduct) != 0 )
                        <x-admin.card.normal>
                            <ul class="child_product_name">
                                @foreach($rowData->childproduct as $childproduct )
                                    <li>{{\App\AppPlugin\Product\ProductController::getChildProductName($childproduct)}}
                                        <span>{{number_format($childproduct->price)}}</span></li>
                                @endforeach
                            </ul>
                            <x-admin.form.action-button url="{{route('admin.Product.Product.manage-attribute',$rowData->id)}}"
                                                        :print-lable="__('admin/proProduct.pro_variant_manage')" :tip="false"/>

                        </x-admin.card.normal>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <x-admin.form.submit-role-back :page-data="$pageData"/>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </x-admin.hmtl.section>




@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    @if($config['TableTags'])
        <x-admin.ajax.tag-serach length="1"/>
    @endif

    @if($config['postEditor'])
        <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
        @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
            <x-admin.java.ckeditor4 name="{{$key}}[short_des]" id="{{$key}}_short_des" :dir="$key" :upload-photo="false" :filebrowser="false"/>
        @endforeach
    @endif

@endpush
