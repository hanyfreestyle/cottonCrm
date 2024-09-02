@if($addTitle)
    <div class="row infoDiv">
        <div class="col-lg-12">
            <h2 class="">{{__('admin/crm.model_h2_ticket')}}</h2>
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
    <x-admin.hmtl.info-div-list n="user_id" :row="$row" col="col-lg-4 col-12"/>
    <x-admin.hmtl.info-div-list n="open_type" :row="$row" col="col-lg-2 col-6"/>
    <x-admin.hmtl.info-div-list n="follow_state" :row="$row" col="col-lg-2 col-6"/>
</div>

<div class="row">
    <x-admin.hmtl.info-div-list n="sours_id" :row="$row" col="col-lg-3 col-6"/>
    <x-admin.hmtl.info-div-list n="ads_id" :row="$row" col="col-lg-3 col-6"/>
    <x-admin.hmtl.info-div-list n="device_id" :row="$row" col="col-lg-3 col-6"/>
    <x-admin.hmtl.info-div-list n="brand_id" :row="$row" col="col-lg-3 col-6"/>
</div>

<div class="row">
    <x-admin.hmtl.info-div-list n="notes_err" :all-data="true" :row="$row" col="col-lg-6 col-12"/>
    <x-admin.hmtl.info-div-list n="notes" :all-data="true" :row="$row" col="col-lg-6 col-12"/>
</div>

@if($row->state == 2)
    <div class="row">
        <x-admin.hmtl.info-div-list n="lastNotes" :row="$row" col="col-lg-12 col-12"/>
    </div>
@endif


@if($addDes)
    @if(count($row->des) > 0 )
        <x-app-plugin.crm-service.leads.lead-info-des :row="$row->des" />
    @endif
@endif





