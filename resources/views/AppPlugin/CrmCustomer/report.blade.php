@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :country-id="true" :city-id="true" :area-id="true"/>

        <div class="row">

            @if(isset($chartData['Evaluation']) and  count($chartData['Evaluation']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__($defLang.'report_evaluation')">
                    <x-admin.report.chart-def id="Evaluation" :data-row="$chartData['Evaluation']"/>
                </x-admin.card.normal>
            @endif

            @if($Config['addCountry'])
                @if(isset($chartData['Country']) and  count($chartData['Country']) > 0)
                    <x-admin.card.normal col="col-lg-3" :title="__($defLang.'report_country')">
                        <x-admin.report.chart-def id="Country" :data-row="$chartData['Country']"/>
                    </x-admin.card.normal>
                @endif

                @if(isset($chartData['City']) and  count($chartData['City']) > 0)
                    <x-admin.card.normal col="col-lg-3" :title="__($defLang.'report_city')">
                        <x-admin.report.chart-def id="City" :data-row="$chartData['City']"/>
                    </x-admin.card.normal>
                @endif

                @if(isset($chartData['Area']) and  count($chartData['Area']) > 0)
                    <x-admin.card.normal col="col-lg-3" :title="__($defLang.'report_area')">
                        <x-admin.report.chart-def id="Area" :data-row="$chartData['Area']"/>
                    </x-admin.card.normal>
                @endif
            @endif


        </div>
    </x-admin.hmtl.section>


@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
@endsection



