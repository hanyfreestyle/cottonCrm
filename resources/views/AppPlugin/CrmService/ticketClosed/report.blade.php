@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <x-app-plugin.crm-service.leads.form-filter form-name="{{$formName}}" :row="$rowData" def-route=".filterReport"
                                                            :state-close="true" :report-view="true" :user="true" :config="$config"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row">
            <x-admin.dashboard.color-card :count="issetArr($card,'all_count')" :title="__('admin/crm.report_card_all_count')"
                                          icon="fas fa-tools" bg="p"/>

            <x-admin.dashboard.color-card :count="issetArr($card,'Finished_count')" :title="__('admin/crm_service_menu.ticket_close_finished')"
                                          icon="fas fa-thumbs-up" bg="s" :url="route('admin.TicketClose.Finished')"/>

            <x-admin.dashboard.color-card :count="issetArr($card,'Cancellation_count')" :title="__('admin/crm_service_menu.ticket_close_cancellation')"
                                          icon="fas fa-power-off" bg="i" :url="route('admin.TicketClose.Cancellation')"/>

            <x-admin.dashboard.color-card :count="issetArr($card,'Reject_count')" :title="__('admin/crm_service_menu.ticket_close_reject')"
                                          icon="fas fa-thumbs-down" bg="d" :url="route('admin.TicketClose.Reject')"/>
        </div>

        <div class="row">

            @canany(['crm_service_open_ticket_admin', 'crm_service_open_ticket_team_leader'])
                <x-admin.report.session-chart id="Users" :l="__('admin/crm_service.label_user_id')" i="fas fa-user-cog" key="user_id"/>
            @endcan

            <x-admin.report.session-chart id="LeadSours" :l="__('admin/crm.label_lead_sours')" i="fas fa-filter" key="sours_id"/>
            <x-admin.report.session-chart id="LeadCategory" :l="__('admin/crm.label_lead_category')" i="fab fa-google" key="ads_id"/>

            <x-admin.report.session-chart id="FollowState" :l="__('admin/crm.label_state')" i="fas fa-tag" key="follow_state"/>
            <x-admin.report.session-chart id="Device" :l="__('admin/crm_service.label_device')" i="fas fa-desktop" key="device_id"/>
            <x-admin.report.session-chart id="BrandName" :l="__('admin/crm_service.label_brand')" i="fas fa-copyright" key="brand_id"/>
            <x-admin.report.session-chart id="Area" :l="__('admin/crm.label_customer_area')" i="fas fa-map-pin" key="area_id"/>

        </div>
    </x-admin.hmtl.section>


@endsection


@section('AddScript')
    <script src="{{ defAdminAssets('flot/jquery.flot.min.js') }}"></script>
    <script src="{{ defAdminAssets('flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ defAdminAssets('plugins/chart.js/Chart.min.js')}}"></script>
@endsection



