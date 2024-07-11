@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-app-plugin.crm.book.form-release-filter form-name="{{$formName}}" :row="$rowData"/>

        <div class="row">
            @if(isset($chartData['Years']) and  count($chartData['Years']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__($defLang.'report_release_years')">
                    <x-admin.report.chart-def id="Years" :data-row="$chartData['Years']"/>
                </x-admin.card.normal>
            @endif

            @if(isset($chartData['Month']) and  count($chartData['Month']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__($defLang.'report_release_month')">
                    <x-admin.report.chart-def id="Month" :data-row="$chartData['Month']"/>
                </x-admin.card.normal>
            @endif

        </div>
    </x-admin.hmtl.section>


@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
@endsection



