@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row">
            <x-admin.dashboard.color-card :count="issetArr($card,'pay_today')" :title="__('admin/crm_service_cash.report_card_today')"
                                          icon="fas fa-tools" bg="p"/>

            <x-admin.dashboard.color-card :count="issetArr($card,'pay_week')" :title="__('admin/crm_service_cash.report_card_week')"
                                          icon="fas fa-bell" bg="s"/>

            <x-admin.dashboard.color-card :count="issetArr($card,'pay_month')" :title="__('admin/crm_service_cash.report_card_month')"
                                          icon="fas fa-history" bg="i"/>

            <x-admin.dashboard.color-card :count="issetArr($card,'pay_un_piad')" :title="__('admin/crm_service_cash.report_card_un_piad')"
                                          icon="fas fa-thumbs-down" bg="d"/>
        </div>
    </x-admin.hmtl.section>
    <x-admin.hmtl.section>
        <div class="row mb-5">
            <div class="col-lg-12">
                <x-app-plugin.crm-service.cash.chart-month :chart-data="$monthChart"/>
            </div>

            <div class="col-lg-12">
                <x-app-plugin.crm-service.cash.chart-year :chart-data="$yearChart"/>
            </div>
        </div>
    </x-admin.hmtl.section>

@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ defAdminAssets('plugins/chart.js/Chart.min.js')}}"></script>
@endsection



