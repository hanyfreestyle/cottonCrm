@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-app-plugin.crm-service.leads.report-open-chart :card="$card" :chart-data="$chartData"/>

@endsection


@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
@endsection



