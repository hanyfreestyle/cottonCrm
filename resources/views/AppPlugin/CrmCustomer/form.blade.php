@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.form.form-def :form-route="route($PrefixRoute.'.update',intval($rowData->id))" :row-data="$rowData" :page-data="$pageData" :full-err="false"  >
        <input type="hidden" name="config" value="{{json_encode($Config)}}">
        <x-app-plugin.crm.customers.form-def :row-data="$rowData" :title="__('admin/crm/customers.box_def')"/>

        @if($Config['addCountry'])
            <x-app-plugin.crm.customers.form-address :row-data="$rowDataAddress" :config="$Config" :title="__('admin/crm/customers.box_address')"/>
        @endif

        <div class="row float-left">
            <x-admin.form.submit-role-back :page-data="$pageData"/>
        </div>

    </x-admin.form.form-def>

@endsection
