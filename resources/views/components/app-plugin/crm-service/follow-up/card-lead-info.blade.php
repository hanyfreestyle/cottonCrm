<x-admin.card.collapsed :open="$open" :outline="$outline" :bg="$bg" :title="__('admin/crm.model_h2_ticket')">
    <div class="row">
        <x-admin.hmtl.info-div-list n="created_at" :row="$ticket" col="col-lg-3 col-6"/>
        <x-admin.hmtl.info-div-list n="follow_date" :row="$ticket" col="col-lg-3 col-6"/>
        <x-admin.hmtl.info-div-list n="user_id" :row="$ticket" col="col-lg-6 col-12"/>
        <x-admin.hmtl.info-div-list n="open_type" :row="$ticket" col="col-lg-3 col-6"/>
        <x-admin.hmtl.info-div-list n="follow_state" :row="$ticket" col="col-lg-3 col-6"/>
        @if($fullInfo)
            <x-admin.hmtl.info-div-list n="sours_id" :row="$ticket" col="col-lg-3 col-6"/>
            <x-admin.hmtl.info-div-list n="ads_id" :row="$ticket" col="col-lg-3 col-6"/>
        @endif
        <x-admin.hmtl.info-div-list n="device_id" :row="$ticket" col="col-lg-3 col-6"/>
        <x-admin.hmtl.info-div-list n="brand_id" :row="$ticket" col="col-lg-3 col-6"/>
    </div>

    <div class="row">
        <x-admin.hmtl.info-div-list n="notes_err" :row="$ticket" col="col-lg-6 col-12"/>
        <x-admin.hmtl.info-div-list n="notes" :row="$ticket" col="col-lg-6 col-12"/>
    </div>
</x-admin.card.collapsed>
