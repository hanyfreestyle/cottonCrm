@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-6">
                <x-app-plugin.crm-service.follow-up.card-customer-info :ticket="$ticket"/>
            </div>
            <div class="col-lg-6">
                <x-app-plugin.crm-service.follow-up.card-lead-info :full-info="true" :ticket="$ticket"/>
            </div>
        </div>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')

@endpush
