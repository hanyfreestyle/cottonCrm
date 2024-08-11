@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
                <x-admin.hmtl.alert-massage  bg="w"  :mass="$Release->printReleaseName()" />

                <input type="hidden" value="{{$Release->id}}" name="periodicals_id">
                @csrf
                <div class="row">
                    <x-admin.form.input name="name" :row="$rowData" :label="__('admin/Periodicals.notes_name')" col="6" tdir="ar"/>
                    <x-admin.form.input name="author" :row="$rowData" :label="__('admin/Periodicals.notes_author')" col="4" tdir="ar" :req="false"/>
                    <x-admin.form.input name="page_num" :row="$rowData" :label="__('admin/Periodicals.notes_page_num')" col="2" tdir="en" :req="false"/>
                </div>
                <x-admin.form.select-multiple :has-trans="false" name="tag_id" :categories="$tags" col="12"
                                              :sel-cat="old('tag_id',$selTags)" :label="__('admin/Periodicals.app_menu_tags')"/>
                <x-admin.form.textarea name="des" :row="$rowData" value="{{old('des',$rowData->des)}}"
                                       :label="__('admin/Periodicals.form_des')" col="12" tdir="ar" :req="false"/>
                <hr>
                <x-admin.form.submit :text="$pageData['ViewType']"/>
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection



@push('JsCode')
    <x-admin.ajax.tag-serach/>
@endpush
