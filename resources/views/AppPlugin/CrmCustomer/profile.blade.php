@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="__($defLang.'box_profile')" :collapsed="false">
            <x-app-plugin.crm.customers.card-profile :row="$rowData" :config="$Config"/>
        </x-admin.card.collapsed>
    </x-admin.hmtl.section>


@endsection
