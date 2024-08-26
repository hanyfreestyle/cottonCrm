@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :config="$Config" :report-view="true" />

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

        <div class="row mb-5 pb-5">
            <x-admin.report.session-chart id="Evaluation" :l="__($defLang.'report_evaluation')" i="fas fa-star" count="2500" />
            @if($Config['addCountry'])
                @if(!$Config['OneCountry'])
                    <x-admin.report.session-chart id="Country" :l="__($defLang.'report_country')"/>
                @endif
                <x-admin.report.session-chart id="City" :l="__($defLang.'report_city')" i="fas fa-flag" key="city_id"/>
                <x-admin.report.session-chart id="Area" :l="__($defLang.'report_area')" i="fas fa-map-pin" key="area_id"/>
            @endif
            <x-admin.report.session-chart id="Gender" :l="__($defLang.'form_gender')" i="fas fa-restroom" key="gender_id"/>
        </div>
    </x-admin.hmtl.section>
@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ defAdminAssets('plugins/chart.js/Chart.min.js')}}"></script>
@endsection



