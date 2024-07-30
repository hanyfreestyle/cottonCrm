@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-app-plugin.crm.book.form-filter form-name="{{$formName}}" :row="$rowData"/>

        <div class="row">
            @if(isset($chartData['Country']) and  count($chartData['Country']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__($defLang.'form_country')">
                    <x-admin.report.chart-def id="Country" :data-row="$chartData['Country']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['Release']) and  count($chartData['Release']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__($defLang.'form_release_name')">
                    <x-admin.report.chart-def id="Release" :data-row="$chartData['Release']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['BookLang']) and  count($chartData['BookLang']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__($defLang.'form_lang')">
                    <x-admin.report.chart-def id="City" :data-row="$chartData['BookLang']"/>
                </x-admin.card.normal>
            @endif
        </div>
    </x-admin.hmtl.section>


@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
@endsection



