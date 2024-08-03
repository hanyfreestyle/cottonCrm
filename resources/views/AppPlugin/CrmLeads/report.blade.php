@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        @if($AllData >0)
            <x-app-plugin.crm.leads.form-filter form-name="{{$formName}}" :row="$rowData" def-route=".filterReport" :view-dates="false" :config="$Config"/>
        @endif

        <div class="row">

            @if(isset($chartData['Device']) and  count($chartData['Device']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_device')">
                    <x-admin.report.chart-def id="Device" :data-row="$chartData['Device']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['BrandName']) and  count($chartData['BrandName']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_brand')">
                    <x-admin.report.chart-def id="BrandName" :data-row="$chartData['BrandName']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['LeadSours']) and  count($chartData['LeadSours']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_lead_sours')">
                    <x-admin.report.chart-def id="LeadSours" :data-row="$chartData['LeadSours']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['LeadCategory']) and  count($chartData['LeadCategory']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_lead_category')">
                    <x-admin.report.chart-def id="LeadCategory" :data-row="$chartData['LeadCategory']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['City']) and  count($chartData['City']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_lead_city')">
                    <x-admin.report.chart-def id="City" :data-row="$chartData['City']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['Area']) and  count($chartData['Area']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_lead_area')">
                    <x-admin.report.chart-def id="Area" :data-row="$chartData['Area']"/>
                </x-admin.card.normal>
            @endif
        </div>
    </x-admin.hmtl.section>
@endsection


@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
@endsection



