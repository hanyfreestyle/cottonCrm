@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-6">
                <x-app-plugin.crm-service.follow-up.card-customer-info :ticket="$ticket" :open="CardOpenState($agent)" :outline="false"/>
            </div>
            <div class="col-lg-6">
                <x-app-plugin.crm-service.follow-up.card-lead-info :ticket="$ticket" :outline="false"/>
            </div>
        </div>



        <x-app-plugin.crm-service.follow-up.update-button :ticket="$ticket" />


    </x-admin.hmtl.section>

@endsection

@push('JsCode')

@endpush
