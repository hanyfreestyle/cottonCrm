@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-6">
                <x-app-plugin.crm-service.follow-up.card-customer-info :ticket="$ticket" :open="CardOpenState($agent)" :outline="false"/>
            </div>
            <div class="col-lg-6">
                <x-app-plugin.crm-service.follow-up.card-lead-info :ticket="$ticket" :outline="false"/>
            </div>
        </div>

        @if(count($ticket->des) >0 )
            <x-app-plugin.crm-service.leads.lead-info-des :row="$ticket->des"/>
        @endif

        @if($viewActionBut)
            <x-app-plugin.crm-service.follow-up.update-button :ticket="$ticket"/>
        @else
            <x-app-plugin.crm-service.follow-up.update-form :ticket="$ticket" :follow-state="$followState"/>
        @endif
    </x-admin.hmtl.section>

@endsection
