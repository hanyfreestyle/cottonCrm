@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="false"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.normal :page-data="$pageData" :title="$pageData['BoxH1']">
            <div class="row">
                <div class="col-md-12">
                    <form class="mainForm" action="{{route($PrefixRoute.'.searchFilter')}}" method="post">
                        @csrf
                        <div class="row CustSearchForm">
                            <x-admin.form.select-arr name="search_type" :sendvalue="old('search_type',issetArr($_POST,'search_type',1))" :send-arr="$searchType"
                                                     :labelview="false" :label="__('admin/crm/customers.search_type')" col="3"/>

                            <x-admin.form.input name="name" :labelview="false" :value="old('name', issetArr($_POST,'name'))" :placeholder="true" col="7" tdir="ar"
                                                :label="__('admin/crm/customers.search_text')"/>
                            <div class="form-group col-lg-2">
                                <button type="submit" name="B1" class="btn btn-primary w-100 float-left">
                                    <i class="fas fa-search"></i> {{__('admin/form.button_serach')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </x-admin.card.normal>

        @if(count($rowData)>0)
            <x-admin.card.normal :page-data="$pageData" :outline="false" :title="$pageData['BoxH2']">
                @include('AppPlugin.CrmCustomer.inc_table')
            </x-admin.card.normal>
        @else
            @if($nodata)
                <div class="col-lg-12">
                    <x-admin.hmtl.alert-massage type="nodata" />
                </div>
            @endif
        @endif

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
@endpush

