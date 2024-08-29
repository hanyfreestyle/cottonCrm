@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    @if($pageData['ViewType'] == "Edit")
        <x-admin.hmtl.section>
            <div class="row mb-3">
                <div class="col-12 dir_button">
                    @can($PrefixRole.'_edit')
                        <x-admin.form.action-button url="{{route($PrefixRoute.'.profile',$rowData->id)}}" :tip="false" type="Profile"/>
                    @endcan
                    @can('crm_service_leads_add')
                        <x-admin.form.action-button url="{{route($PrefixRoute.'.addTicket',$rowData->id)}}" :tip="false" type="addTicket"/>
                    @endcan
                </div>
            </div>
        </x-admin.hmtl.section>
    @endif



    <x-admin.form.form-def :form-route="route($PrefixRoute.'.update',intval($rowData->id))" :row-data="$rowData" :page-data="$pageData" :full-err="false">
        <input type="hidden" name="config" value="{{json_encode($config)}}">
        <input type="hidden" name="add_type" value="{{$pageData['ViewType']}}"/>
        <x-app-plugin.crm.customers.form-def :row-data="$rowData" :title="__($defLang.'box_def')"/>

        @if( IsConfig( $config,'addCountry'))
            <x-app-plugin.crm.customers.form-address :row-data="$rowDataAddress" :config="$config" :title="__($defLang.'box_address')"/>
        @endif

        <div class="row float-left mb-5">
            <x-admin.form.submit-role-back :page-data="$pageData"/>
        </div>

    </x-admin.form.form-def>

@endsection
