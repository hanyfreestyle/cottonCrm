@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection
@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <x-admin.card.normal :page-data="$pageData" :title="$pageData['BoxH1']">
            <div class="row InfoViewList">
                <h2 class="h2_info des bg-danger">{{__('admin/crm/ticket.fr_change_h2')}}</h2>
            </div>
            <form action="{{route($PrefixRoute.'.changeUserUpdate' ,$rowData->id)}}" method="post">
                @csrf
                <div class="row">
                    <x-app-plugin.crm-service.leads.user-select type="changeUser" :row="$rowData" col="12" :col-mobile="12" :labelview="false" :req="false"/>
                </div>

                <div class="container-fluid mt-3 mb-5">
                    <x-admin.form.submit text="{{__('admin/crm/ticket.fr_change_but')}}"/>
                </div>
            </form>
            <div class="InfoViewList">
                <x-app-plugin.crm.customers.card-profile :row="$rowData->customer" :add-title="true"  view-list="text" :soft-data="true" :config="$Config"/>
                <x-app-plugin.crm-service.leads.lead-info :add-title="true" view-list="text" :row="$rowData"/>
            </div>


        </x-admin.card.normal>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')

@endpush

