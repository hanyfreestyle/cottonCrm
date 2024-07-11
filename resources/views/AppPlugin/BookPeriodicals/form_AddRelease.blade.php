@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-lg-12 dir_button">
                <x-admin.form.action-button url="{{route('admin.Periodicals.AddReleaseYears',$Periodicals->id)}}"
                                            :print-lable="__('admin/Periodicals.but_add_year_list')" icon="fas fa-layer-group"  :tip="false"/>
                <x-admin.form.action-button url="{{route('admin.Periodicals.ListRelease',$Periodicals->id)}}" type="ListRelease" :tip="false"/>

            </div>
        </div>
    </x-admin.hmtl.section>

    <x-app-plugin.crm.book.periodicals-info :row="$Periodicals" />

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
