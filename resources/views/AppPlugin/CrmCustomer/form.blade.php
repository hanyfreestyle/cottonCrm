@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.form.form-def :form-route="route($PrefixRoute.'.update',intval($rowData->id))" :row-data="$rowData" :page-data="$pageData">

        <x-app-plugin.crm.customers.form-def :row-data="$rowData" :title="__('admin/crm/customers.box_def')"/>

        @if($Config['addCountry'])
            <x-app-plugin.crm.customers.form-address :row-data="$rowDataAdress" :title="__('admin/crm/customers.box_address')"/>
        @endif


        <x-admin.form.submit-role-back :page-data="$pageData"/>
    </x-admin.form.form-def>

@endsection
