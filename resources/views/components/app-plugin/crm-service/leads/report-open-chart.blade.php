<x-admin.hmtl.section>
    <div class="row">
        <x-admin.dashboard.color-card :count="issetArr($card,'all_count')" :title="__('admin/crm.report_card_all_count')"
                                      icon="fas fa-tools" bg="p"/>

        <x-admin.dashboard.color-card :count="issetArr($card,'today_count')" :title="__('admin/crm_service_menu.follow_list_today')"
                                      icon="fas fa-bell" bg="s" :url="route('admin.TechFollowUp.Today')"/>

        <x-admin.dashboard.color-card :count="issetArr($card,'next_count')" :title="__('admin/crm_service_menu.follow_list_next')"
                                      icon="fas fa-history" bg="i" :url="route('admin.TechFollowUp.Next')"/>

        <x-admin.dashboard.color-card :count="issetArr($card,'back_count')" :title="__('admin/crm_service_menu.follow_list_back')"
                                      icon="fas fa-thumbs-down" bg="d" :url="route('admin.TechFollowUp.Back')"/>
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
