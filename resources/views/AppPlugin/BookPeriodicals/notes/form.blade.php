@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
                <x-admin.hmtl.alert-massage :mass="$Release->printReleaseName()" />

                <input type="hidden" value="{{$Release->id}}" name="periodicals_id">
                @csrf
                <x-admin.form.input name="name" :row="$rowData" :label="__('admin/Periodicals.notes_name')" col="12" tdir="ar"/>
                <x-admin.form.select-multiple :has-trans="false" name="tag_id" :categories="$tags" :sel-cat="$selTags" col="12"
                                              :label="__('admin/Periodicals.app_menu_tags')"/>
                <x-admin.form.textarea name="des" :row="$rowData" value="{{old('des',$rowData->des)}}"
                                       :label="__('admin/Periodicals.form_des')" col="12" tdir="ar" :req="false"/>
                <hr>
                <x-admin.form.submit :text="$pageData['ViewType']"/>
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection



@push('JsCode')

@endpush
