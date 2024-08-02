@if($addTitle)
    <div class="row">
        <h2 class="h2_info">{{__('admin/crm/ticket.t_h2_ticket')}}</h2>
    </div>
@endif
<div class="row">
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.var_date_add')" :des="PrintDate($row->created_at)" col="2" col-row="col-6" :all-data="false"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_follow_date')" :des="PrintDate($row->follow_date)" col="2" col-row="col-6" :all-data="false"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_user_id')" :arr-data="$CashUsersList" :des="$row->user_id" col="4" col-row="col-6" :all-data="false"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.var_open_type')" :arr-data="$DefCat['TicketOpenType']" :des="$row->open_type" col="2" col-row="col-6" :all-data="false"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.var_ticket_state')" :arr-data="$DefCat['TicketState']" :des="$row->follow_state" col="2" col-row="col-6" :all-data="false"/>
</div>

<div class="row">
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_lead_sours')" :arr-data="$CashConfigDataList" :des="$row->sours_id" col="3" col-row="col-6"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_lead_ads')" :arr-data="$CashConfigDataList" :des="$row->ads_id" col="3" col-row="col-6"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_lead_divce')" :arr-data="$CashConfigDataList" :des="$row->device_id" col="3" col-row="col-6"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_lead_brand')" :arr-data="$CashConfigDataList" :des="$row->brand_id" col="3" col-row="col-6"/>
</div>

<div class="row">
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_notes_err')" :des="$row->notes_err" col="6" col-row="col-12" :all-data="false"/>
    <x-admin.hmtl.info-div :t="__('admin/crm/ticket.fr_notes')" :des="$row->notes" col="6" col-row="col-12" :all-data="false"/>
</div>

