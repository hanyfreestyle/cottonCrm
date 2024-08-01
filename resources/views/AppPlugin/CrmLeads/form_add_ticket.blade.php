@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="__($defLang.'box_profile')" :open="true" :collapsed="true">
            <x-app-plugin.crm.customers.card-profile :row="$customer" :soft-data="true"/>
        </x-admin.card.collapsed>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')

@endpush

