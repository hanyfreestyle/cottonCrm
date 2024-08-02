@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-app-plugin.crm.customers.card-profile :row="$row->customer" :soft-data="true" :add-title="true" :config="$Config"/>
        <x-app-plugin.crm.leads.lead-info :row="$row" :add-title="true"/>
    </x-admin.hmtl.section>

@endsection

@push('JsCode')

@endpush

