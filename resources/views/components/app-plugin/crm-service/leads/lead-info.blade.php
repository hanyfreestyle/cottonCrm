@if($addTitle)
    <div class="row infoDiv">
        <div class="col-lg-12">
            <h2 class="model_h2">{{__('admin/crm.model_h2_ticket')}}</h2>
        </div>
    </div>
@endif
<div class="row">
    <x-admin.hmtl.info-div-list n="created_at" :row="$row" col="col-lg-2 col-6"/>
    @if($row->state == 1)
        <x-admin.hmtl.info-div-list n="follow_date" :row="$row" col="col-lg-2 col-6"/>
    @else
        <x-admin.hmtl.info-div-list n="close_date" :row="$row" col="col-lg-2 col-6"/>
    @endif
    <x-admin.hmtl.info-div-list n="user_id" :row="$row" col="col-lg-3 col-12"/>
    <x-admin.hmtl.info-div-list n="open_type" :row="$row" col="col-lg-2 col-6"/>
    <x-admin.hmtl.info-div-list n="follow_state" :row="$row" col="col-lg-3 col-6"/>
</div>

<div class="row">
    <x-admin.hmtl.info-div-list n="sours_id" :row="$row" col="col-lg-3 col-6"/>
    <x-admin.hmtl.info-div-list n="ads_id" :row="$row" col="col-lg-3 col-6"/>
    <x-admin.hmtl.info-div-list n="device_id" :row="$row" col="col-lg-3 col-6"/>
    <x-admin.hmtl.info-div-list n="brand_id" :row="$row" col="col-lg-3 col-6"/>
</div>

<div class="row">
    <x-admin.hmtl.info-div-list n="notes_err" :all-data="true" :row="$row" col="col-lg-6 col-12"/>
    <x-admin.hmtl.info-div-list n="notes" :all-data="false" :row="$row" col="col-lg-6 col-12"/>
</div>


@if($row->state == 2)
    <div class="row">
        @if(count($cashInfo) == 2 )
            @php
                $total = 0 ;
            @endphp
            @foreach($cashInfo as $cash)
                @if($cash->amount)
                    @if($cash->amount_type == 2)
                        <x-admin.hmtl.info-div i="fas fa-funnel-dollar" :t="__('admin/crm_service_var.cash_type_2')" :des="number_format($cash->amount)" col="col-lg-4 col-6" :all-data="true"/>
                    @elseif($cash->amount_type == 1)
                        <x-admin.hmtl.info-div i="fas fa-file-invoice-dollar" :t="__('admin/crm_service_var.cash_type_4')" :des="number_format($cash->amount)" col="col-lg-4 col-6" :all-data="true"/>
                    @endif
                @endif
                @php
                    $total = $total + $cash->amount;
                @endphp
            @endforeach
            <x-admin.hmtl.info-div i="fas fa-hand-holding-usd" :t="__('admin/crm_service_var.cash_type_1')" :des="number_format($total)" col="col-lg-4 col-12" :all-data="true"/>

        @elseif(count($cashInfo) == 1)
            @foreach($cashInfo as $cash)
                @if($cash->amount)
                    @if($cash->amount_type == 1)
                        <x-admin.hmtl.info-div i="fas fa-hand-holding-usd" :t="__('admin/crm_service_var.cash_type_1')" :des="number_format($cash->amount)" col="col-lg-6 col-12" :all-data="true"/>
                    @elseif($cash->amount_type == 3)
                        <x-admin.hmtl.info-div i="fas fa-hand-holding-usd" :t="__('admin/crm_service_var.cash_type_3')" :des="number_format($cash->amount)" col="col-lg-6 col-12" :all-data="true"/>
                    @endif
                @endif
            @endforeach
        @endif

        @if(count($cashBaskInfo) > 0)
            @foreach($cashBaskInfo as $cash)
                <x-admin.hmtl.info-div i="fas fa-hand-holding-usd" :t="__('admin/crm_service_menu.ticket_cash_back')" :des="number_format($cash->amount)" col="col-lg-6 col-12" :all-data="true"/>
            @endforeach
        @endif
    </div>
@endif

@if($addDes)
    @if(count($row->des) > 0 )
        <x-app-plugin.crm-service.leads.lead-info-des :row="$row->des"/>
    @endif
@endif





