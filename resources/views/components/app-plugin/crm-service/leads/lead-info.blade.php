@if($addTitle)
    <div class="row infoDiv">
        <div class="col-lg-12">
            <h2 class="">{{__('admin/crm.model_h2_ticket')}}</h2>
        </div>
    </div>
@endif
<div class="row">
    <x-admin.hmtl.info-div-list n="created_at" :row="$row" col="col-lg-2 col-6"/>
    <x-admin.hmtl.info-div-list n="follow_date" :row="$row" col="col-lg-2 col-6"/>
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
    <x-admin.hmtl.info-div-list n="notes_err" :row="$row" col="col-lg-6 col-12"/>
    <x-admin.hmtl.info-div-list n="notes" :row="$row" col="col-lg-6 col-12"/>

</div>
