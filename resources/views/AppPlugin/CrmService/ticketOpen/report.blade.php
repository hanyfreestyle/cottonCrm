@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <x-app-plugin.crm-service.leads.form-filter form-name="{{$formName}}" :row="$rowData" def-route=".filterReport"
                                                            :report-view="true" :user="true" :state-open="true" :config="$config"/>
            </div>
        </div>
    </x-admin.hmtl.section>


    <x-app-plugin.crm-service.leads.report-open-chart :card="$card" :chart-data="$chartData" :report-view="true" />

@endsection


@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>

@endsection



