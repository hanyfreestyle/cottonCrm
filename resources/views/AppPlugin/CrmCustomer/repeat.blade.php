@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="false"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            @if(count($rowData)>0)
                @include('AppPlugin.CrmCustomer.inc_table')
            @endif
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection

