@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if(count($rowData) > 0 )
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-dark"> {{ __('admin/crm_service_cash.label_sum_user') ." ". number_format($totalAmount) }}</div>
                </div>
            </div>
            <div class="row">
                @foreach($rowData as $row)
                    <x-app-plugin.crm-service.cash.get-card :row="$row" :open="false"/>
                @endforeach
            </div>
        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif
    </x-admin.hmtl.section>

@endsection

@push('JsCode')

@endpush
