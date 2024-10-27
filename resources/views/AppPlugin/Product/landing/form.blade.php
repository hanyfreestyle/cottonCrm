@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    {{--    <x-admin.hmtl.top-edit-page :page-data="$pageData" :row="$rowData" web-slug="BlogView"/>--}}
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">


                <div class="row">

                    <x-admin.form.select-arr name="is_soft" :sendvalue="old('is_soft',$rowData->is_soft)"
                                             label="Soft View" col="3"
                                             select-type="selActive"/>

                    <x-admin.form.select-arr name="brand_id" sendvalue="{{old('brand_id',$rowData->brand_id)}}" :required-span="false"
                                             :send-arr="$CashBrandList" label="{{__('admin/proProduct.app_menu_brand')}}" col="3"/>

                    <x-admin.form.select-multiple name="product_id" label="المنتجات" :categories="$Products" :sel-cat="old('product_id',$selPro)" col="12"/>

                </div>

                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )


                        <div class="row">
                            <x-admin.form.trans-input name="name" col="6" :key="$key" :row="$rowData" label="اسم العرض" :tdir="$key"/>
                            <x-admin.form.trans-input name="slug" col="6" :key="$key" :row="$rowData" :label="__('admin/form.text_g_slug')" :tdir="$key"/>

                            <x-admin.form.trans-text-area name="desup" :key="$key" :row="$rowData" label="وصف الصفحة يظهر اعلى المنتجات" :tdir="$key"
                                                          add-class="bigTextArea" :req="false"/>

                            <x-admin.form.trans-text-area name="des" :key="$key" :row="$rowData" label="وصف الصفحة يظهر اسفل المنتجات" :tdir="$key"
                                                          add-class="bigTextArea" :req="false"/>



                            <x-admin.form.trans-input name="g_title" col="12" :key="$key" :row="$rowData" :label="__('admin/form.text_g_title')" :req="true"
                                                      :tdir="$key"/>
                            <x-admin.form.trans-text-area name="g_des" col="12" :key="$key" :row="$rowData" :label="__('admin/form.text_g_des')" :req="true"
                                                          :tdir="$key"/>
                        </div>
                    @endforeach
                </div>

                <hr>
                <x-admin.form.check-active name="is_active" :row="$rowData" :page-view="$pageData['ViewType']"/>
                <hr>
                <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>
                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
    @foreach ( config('app.web_lang') as $key=>$lang )
        <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
        <x-admin.java.ckeditor4 name="{{$key}}[desup]" id="{{$key}}_desup" :dir="$key"/>
    @endforeach
@endpush
