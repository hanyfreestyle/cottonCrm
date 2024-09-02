<x-admin.card.collapsed :open="$open" :outline="$outline" :bg="$bg" :title="__('admin/crm.model_h2_customer')">
    <div class="row">
        <x-admin.hmtl.info-div-list n="name" :row="$ticket->customer" col="col-lg-6 col-12"/>
        <x-admin.hmtl.info-div-list n="mobile" :row="$ticket->customer" col="col-lg-4 col-6"/>
        <x-admin.hmtl.info-div-list n="mobile_2" :row="$ticket->customer" col="col-lg-4 col-6"/>
    </div>
    @if(issetArr($config,'addCountry',false))
        @foreach($ticket->customer->address as $address)
            <div class="row">
                @if(issetArr($config,'fullAddress',false))
                    <x-admin.hmtl.info-div-list n="address" :row="$address" col="col-lg-12 col-12"/>
                    <x-admin.hmtl.info-div-list n="unit_num" :row="$address" col="col-lg-4 col-6"/>
                    <x-admin.hmtl.info-div-list n="floor" :row="$address" col="col-lg-4 col-6"/>
                @endif
                <x-admin.hmtl.info-div-list n="city_id" :row="$address" col="col-lg-4 col-6"/>
                <x-admin.hmtl.info-div-list n="area_id" :row="$address" col="col-lg-4 col-6"/>
            </div>
        @endforeach
    @endif
</x-admin.card.collapsed>
