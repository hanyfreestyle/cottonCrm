@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-6">
            </div>
            <div class="col-6 dir_button">
                <x-admin.form.action-button url="{{route('admin.Periodicals.ListRelease',$Periodicals->id)}}" type="ListRelease" :tip="false"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.normal>
            <div class="row">
                <x-admin.hmtl.info-div :t="__($defLang.'form_name')" :des="$Periodicals->name" col="4"/>
                <x-admin.hmtl.info-div :t="__($defLang.'form_des')" :des="$Periodicals->des" col="8"/>
            </div>
            <div class="row">
                <x-admin.hmtl.info-div :arr-data="$CashCountryList" :t="__($defLang.'form_country')" :des="$Periodicals->country_id" col="3"/>
                <x-admin.hmtl.info-div :arr-data="$configData" :t="__($defLang.'form_release_name')" :des="$Periodicals->release_id" col="3"/>
                <x-admin.hmtl.info-div :arr-data="$configData" :t="__($defLang.'form_lang')" :des="$Periodicals->lang_id" col="3"/>
                <x-admin.hmtl.info-div :t="__($defLang.'form_release_count')" :des="$Periodicals->release_count" col="3"/>
            </div>
        </x-admin.card.normal>
    </x-admin.hmtl.section>


    <x-admin.form.form-def :form-route="route($PrefixRoute.'.AddEditOneRelease',intval($PeriodicalsRelease->id))" :row-data="$PeriodicalsRelease" :page-data="$pageData">
        <div class="box_form mt-4">
            <span class="box_title">{{$pageData['BoxH1']}}</span>
            <div class="row">
                <input type="hidden" name="periodicals_id" value="{{$Periodicals->id}}">
                <x-admin.form.input name="year" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_year')" col="2" tdir="ar"/>
                <x-admin.form.input name="month" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_month')" col="2" tdir="ar"/>
                <x-admin.form.input name="number" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_num')" col="2" tdir="ar"/>
                <x-admin.form.input name="notes" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_notes')" col="4" tdir="ar" :req="false"/>
                <x-admin.form.input name="repeat" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_repeat')" col="2" tdir="ar" :req="false"/>
            </div>
        </div>
        <x-admin.form.submit :text="$pageData['ViewType']"/>
    </x-admin.form.form-def>

@endsection
