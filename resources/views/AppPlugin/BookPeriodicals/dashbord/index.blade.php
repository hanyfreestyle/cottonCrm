@extends('admin.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('AppPlugin.BookPeriodicals.dashbord.inc_count')
                </div>
                <div class="col-lg-12">
                    @include('AppPlugin.BookPeriodicals.dashbord.inc_add_release')
                </div>
            </div>
        </div>
    </section>

    @can('Periodicals_report')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <x-app-plugin.crm.book.chart-week/>
                    </div>

                    <div class="col-lg-6">
                        <x-app-plugin.crm.book.chart-month/>
                    </div>

                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        @include('AppPlugin.BookPeriodicals.dashbord.inc_most_tags')
                    </div>
                    <div class="col-lg-6">
                        @include('AppPlugin.BookPeriodicals.dashbord.inc_most_release')
                    </div>
                </div>
            </div>
        </section>
    @endcan


    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12 mb-lg-3 mb-3">
            </div>
        </div>

        <div class="row">

        </div>
    </x-admin.hmtl.section>

@endsection
@push('JsCode')
    <script src="{{defAdminAssets('plugins/chart.js/Chart.min.js')}}"></script>
@endpush
