@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>

        <x-app-plugin.crm-service.leads.form-filter form-name="{{$formName}}" :row="$rowData" def-route=".filterReport" :view-dates="false" :config="$config"/>


        @if(issetArr($session,'filter_last_add',true))
            <div class="row">
                <div class="col-lg-6">
                    <x-admin.report.chart-week :chart-data="$weekChart"/>
                </div>
                <div class="col-lg-6">
                    <x-admin.report.chart-month :chart-data="$monthChart"/>
                </div>
            </div>
        @endif


        <div class="row">
            <x-admin.report.session-chart id="Device" :l="__('admin/crm_service.label_device')" i="fas fa-desktop" key="device_id"/>
            <x-admin.report.session-chart id="BrandName" :l="__('admin/crm_service.label_brand')" i="fas fa-copyright" key="brand_id"/>
            <x-admin.report.session-chart id="LeadSours" :l="__('admin/crm.label_lead_sours')" i="fas fa-filter" key="sours_id"/>
            <x-admin.report.session-chart id="LeadCategory" :l="__('admin/crm.label_lead_category')" i="fab fa-google" key="ads_id"/>
            <x-admin.report.session-chart id="City" :l="__('admin/crm.label_lead_city')" i="fas fa-flag" key="city_id"/>
            <x-admin.report.session-chart id="Area" :l="__('admin/crm.label_customer_area')" i="fas fa-map-pin" key="area_id"/>
        </div>

    </x-admin.hmtl.section>
@endsection


@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ defAdminAssets('plugins/chart.js/Chart.min.js')}}"></script>
@endsection



