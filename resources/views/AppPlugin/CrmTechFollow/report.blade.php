@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>

{{--        @if($AllData >0)--}}
{{--            <x-app-plugin.crm.leads.form-filter form-name="{{$formName}}" :row="$rowData" def-route=".filterReport" :view-dates="false" :config="$Config"/>--}}
{{--        @endif--}}

            <div class="row">
                <x-admin.dashboard.color-card
                    :count="issetArr($card,'all_count')"
                    :title="__('admin/crm/leads.report_card_all_count')"
                    icon="fas fa-tools"
                    bg="p"
                   />

                <x-admin.dashboard.color-card
                    :count="issetArr($card,'today_count')"
                    :title="__('admin/crm/ticket.app_menu_today')"
                    icon="fas fa-bell"
                    bg="s"
                    :url="route('admin.TechFollowUp.Today')"/>

                <x-admin.dashboard.color-card
                    :count="issetArr($card,'next_count')"
                    :title="__('admin/crm/ticket.app_menu_next')"
                    icon="fas fa-history"
                    bg="i"
                    :url="route('admin.TechFollowUp.Next')"/>

                <x-admin.dashboard.color-card
                    :count="issetArr($card,'back_count')"
                    :title="__('admin/crm/ticket.app_menu_back')"
                    icon="fas fa-thumbs-down"
                    bg="d"
                    :url="route('admin.TechFollowUp.Back')"/>
            </div>


        <div class="row">

            @canany(['crm_tech_follow_admin', 'crm_tech_follow_team_leader'])
                @if(isset($chartData['Users']) and  count($chartData['Users']) > 0)
                    <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_users')">
                        <x-admin.report.chart-def id="Users" :data-row="$chartData['Users']"/>
                    </x-admin.card.normal>
                @endif
            @endcan

            @if(isset($chartData['FollowState']) and  count($chartData['FollowState']) > 0)
                <x-admin.card.normal col="col-lg-3" :title="__('admin/crm/leads.report_device')">
                    <x-admin.report.chart-def id="FollowState" :data-row="$chartData['FollowState']"/>
                </x-admin.card.normal>
            @endif

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



