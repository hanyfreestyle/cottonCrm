@if($addTitle)
    <div class="row infoDiv">
        <div class="col-lg-12">
            <h2 class="">{{__('admin/crm/ticket.t_h2_customer')}}</h2>
        </div>
    </div>
@endif

@if($softData)

    <div class="row">
        <x-admin.hmtl.info-div-list n="name" :row="$row" col="col-lg-4 col-12"/>
        <x-admin.hmtl.info-div-list n="mobile" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="mobile_2" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="phone" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="whatsapp" :row="$row" col="col-lg-2 col-6"/>
    </div>


    @if(issetArr($config,'addCountry',false))
        @foreach($row->address as $address)
            <div class="row">
                @if(issetArr($config,'fullAddress',false))
                    <x-admin.hmtl.info-div-list n="address" :row="$address" col="col-lg-4 col-12"/>
                    <x-admin.hmtl.info-div-list n="unit_num" :row="$address" col="col-lg-2 col-6"/>
                    <x-admin.hmtl.info-div-list n="floor" :row="$address" col="col-lg-2 col-6"/>
                @endif
                <x-admin.hmtl.info-div-list n="city_id" :row="$address" col="col-lg-2 col-6"/>
                <x-admin.hmtl.info-div-list n="area_id" :row="$address" col="col-lg-2 col-6"/>
            </div>
        @endforeach
    @endif
@else
    <div class="row">

        <x-admin.hmtl.info-div-list n="name" :row="$row" col="col-lg-4 col-12"/>
        @if(issetArr($config,'evaluation',false))
            <x-admin.hmtl.info-div-list n="evaluation_id" :row="$row" col="col-lg-2 col-6"/>
        @endif

        @if(issetArr($config,'gender',false))
            <x-admin.hmtl.info-div-list n="gender_id" :row="$row" col="col-lg-2 col-6"/>
        @endif
    </div>

    <div class="row">
        <x-admin.hmtl.info-div-list n="mobile" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="mobile_2" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="phone" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="whatsapp" :row="$row" col="col-lg-2 col-6"/>
        <x-admin.hmtl.info-div-list n="email" :row="$row" col="col-lg-2 col-12"/>
    </div>



    @if(issetArr($config,'addCountry',false))
        @if(issetArr($config,'fullAddress',false))
            <div class="row infoDiv">
                <div class="col-lg-12"><h2 class="">{{__($defLang.'box_address')}}</h2></div>
            </div>
        @endif
        @foreach($row->address as  $address)

            @if(issetArr($config,'fullAddress',false))
                <div class="row">
                    <x-admin.hmtl.info-div-list n="address" :row="$address" col="col-lg-4 col-12"/>
                    <x-admin.hmtl.info-div-list n="unit_num" :row="$address" col="col-lg-2 col-6"/>
                    <x-admin.hmtl.info-div-list n="floor" :row="$address" col="col-lg-2 col-6"/>
                    <x-admin.hmtl.info-div-list n="post_code" :row="$address" col="col-lg-2 col-6"/>
                    @if(issetArr($config,'postcode',false))
                        <x-admin.hmtl.info-div :t="__($defLang.'form_ad_post_code')" :des="$address->post_code" col="2" col-row="col-4" :all-data="$allData"/>
                    @endif
                </div>
            @endif

            <div class="row">
                @if(!issetArr($config,'OneCountry',false))
                    <x-admin.hmtl.info-div-list n="country_id" :row="$address" col="col-lg-2 col-6"/>

                @endif
                <x-admin.hmtl.info-div-list n="city_id" :row="$address" col="col-lg-2 col-6"/>
                <x-admin.hmtl.info-div-list n="area_id" :row="$address" col="col-lg-2 col-6"/>

                @if(issetArr($config,'googleAddress',false))
                    <x-admin.hmtl.info-div-list n="latitude" :row="$address" col="col-lg-2 col-6"/>
                @endif
            </div>
        @endforeach
    @endif
@endif