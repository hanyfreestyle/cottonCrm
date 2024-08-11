@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.form.form-def :form-route="route($PrefixRoute.'.update',intval($rowData->id))" :row-data="$rowData" :page-data="$pageData">

        <div class="box_form">

            <span class="box_title">{{$pageData['BoxH1']}}</span>

            <div class="row">
                <x-admin.form.input name="name" :row="$rowData" :label="__($defLang.'form_name')" col="4" tdir="ar"/>
                <x-admin.form.input name="des" :row="$rowData" :label="__($defLang.'form_des')" col="8" tdir="ar"/>
            </div>

            <div class="row">
                <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($rowData,'country_id'))" add-filde="phone"
                                         :send-arr="$CashCountryList" label="{{__('admin/dataCity.form_country')}}" col="3"/>
                <x-admin.form.select-data name="release_id" :row="$rowData" cat-id="BookRelease" :label="__($defLang.'form_release_name')" :req="false"/>
                <x-admin.form.select-data name="lang_id" :row="$rowData" cat-id="BookLang" :label="__($defLang.'form_lang')" :req="false"/>
            </div>
        </div>

        <x-admin.form.submit-role-back :page-data="$pageData"/>
    </x-admin.form.form-def>

@endsection
