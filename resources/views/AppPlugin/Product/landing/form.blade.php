@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">
            <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">

            <div class="row">
                <div class="col-lg-12">
                    <x-admin.form.print-error-div :full-err="true"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            <div class="row">
                                <x-admin.form.select-multiple name="product_id" label="المنتجات" :categories="$Products" :sel-cat="old('product_id',$selPro)" col="12"/>
                            </div>
                            <div class="row">
                                @foreach ( $LangAdd as $key=>$lang )
                                    <x-admin.form.trans-input name="name" col="6" :key="$key" :row="$rowData" label="اسم العرض" :tdir="$key"/>
                                    <x-admin.form.trans-input name="slug" col="6" :key="$key" :row="$rowData" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
                                    @if($rowData->is_des or $rowData->des != null)
                                        <x-admin.form.trans-text-area name="des_up" :key="$key" :row="$rowData" label="وصف الصفحة يظهر اعلى المنتجات" :tdir="$key" add-class="bigTextArea" :req="false"/>
                                        <x-admin.form.trans-text-area name="des" :key="$key" :row="$rowData" label="وصف الصفحة يظهر اسفل المنتجات" :tdir="$key" add-class="bigTextArea" :req="false"/>
                                    @endif
                                @endforeach
                            </div>
                        </x-admin.card.normal>

                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-12 float-left text-left">
                            <x-admin.form.submit-role-back :page-data="$pageData"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            <div class="row">
                                <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="12"/>
                            </div>
                        </x-admin.card.normal>
                    </div>

                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            <div class="row">
                                <x-admin.form.select-arr name="is_active" :sendvalue="old('is_active',IsArr($rowData,'is_active',1))" :label="__('admin/def.status')" col="12" type="selActive"/>
                            </div>

                            <div class="row">
                                @if(IsConfig($config,"TableBrand"))
                                    <x-admin.form.select-arr name="brand_id" :sendvalue="old('brand_id',$rowData->brand_id)" col="12" :req="false" :send-arr="$CashBrandList"
                                                             :l="__('admin/proProduct.app_menu_brand')"/>
                                @endif

                                <x-admin.form.select-arr name="is_des" :sendvalue="old('is_des',$rowData->is_des)" l="يحتوى على وصف" col="12" :req="false" type="selActive"/>
                                @if($rowData->is_des)
                                    <x-admin.form.select-arr name="is_soft" :sendvalue="old('is_soft',$rowData->is_soft)" l="Soft View" col="12" :req="false" type="selActive"/>
                                @endif

                            </div>
                        </x-admin.card.normal>
                    </div>
                    @include('admin.mainView.category.inc_seo_side')

                    <div class="row mb-5">
                        <div class="col-lg-12 float-left text-left">
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
    <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
    @foreach ( config('app.web_lang') as $key=>$lang )
        <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
        <x-admin.java.ckeditor4 name="{{$key}}[des_up]" id="{{$key}}_des_up" :dir="$key"/>
    @endforeach
@endpush
