@if($softData)
    <div class="row">
        <x-admin.hmtl.info-div :t="__($defLang.'form_name')" :des="$row->name" col="4" col-row="col-12" :all-data="false"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_mobile')" :des="$row->mobile" col="2" col-row="col-6" :all-data="false"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_mobile_2')" :des="$row->mobile_2" col="2" col-row="col-6" :all-data="false"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_phone')" :des="$row->phone" col="2" col-row="col-6" :all-data="false"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_whatsapp')" :des="$row->whatsapp" col="2" col-row="col-6" :all-data="false"/>
    </div>


@else
    <div class="row">

        <x-admin.hmtl.info-div :t="__($defLang.'form_name')" :des="$row->name" col="4" col-row="col-12" :all-data="$allData"/>
        @if(issetArr($config,'evaluation',false))
            <x-admin.hmtl.info-div :t="__($defLang.'form_evaluation')" :arr-data="$CashConfigDataList" :des="$row->evaluation_id" col="2" col-row="col-6" :all-data="$allData"/>
        @endif
        @if(issetArr($config,'gender',false))
            <x-admin.hmtl.info-div :t="__($defLang.'form_gender')" :arr-data="$DefCat['gender']" :des="$row->gender_id" col="2" col-row="col-6" :all-data="$allData"/>
        @endif
    </div>

    <div class="row">
        <x-admin.hmtl.info-div :t="__($defLang.'form_mobile')" :des="$row->mobile" col="3" col-row="col-6" :all-data="$allData"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_mobile_2')" :des="$row->mobile_2" col="3" col-row="col-6" :all-data="$allData"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_phone')" :des="$row->phone" col="3" col-row="col-6" :all-data="$allData"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_whatsapp')" :des="$row->whatsapp" col="3" col-row="col-6" :all-data="$allData"/>
        <x-admin.hmtl.info-div :t="__($defLang.'form_email')" :des="$row->email" col="3" :all-data="$allData"/>
    </div>



    @if(issetArr($config,'addCountry',false))
        @if(issetArr($config,'fullAddress',false))
            <div class="row">
                <div class="col-lg-12"><h2 class="card_h2">{{__($defLang.'box_address')}}</h2></div>
            </div>
        @endif
        @foreach($row->address as  $address)
            <div class="row">
                @if(!issetArr($config,'OneCountry',false))
                    <x-admin.hmtl.info-div :t="__($defLang.'form_ad_country')" :arr-data="$CashCountryList" :des="$address->country_id" col="4" col-row="col-6" :all-data="$allData"/>
                @endif
                <x-admin.hmtl.info-div :t="__($defLang.'form_ad_city')" :arr-data="$CashCityList" :des="$address->city_id" col="4" col-row="col-6" :all-data="$allData"/>
                <x-admin.hmtl.info-div :t="__($defLang.'form_ad_area')" :arr-data="$CashAreaList" :des="$address->area_id" col="4" col-row="col-6" :all-data="$allData"/>
            </div>
            @if(issetArr($config,'fullAddress',false))
                <div class="row">
                    <x-admin.hmtl.info-div :t="__($defLang.'form_ad_address')" :des="$address->address" col="6" col-row="col-12" :all-data="$allData"/>
                    <x-admin.hmtl.info-div :t="__($defLang.'form_ad_unit_num')" :des="$address->unit_num" col="2" col-row="col-4" :all-data="$allData"/>
                    <x-admin.hmtl.info-div :t="__($defLang.'form_ad_floor')" :des="$address->floor" col="2" col-row="col-4" :all-data="$allData"/>

                    @if(issetArr($config,'postcode',false))
                        <x-admin.hmtl.info-div :t="__($defLang.'form_ad_post_code')" :des="$address->post_code" col="2" col-row="col-4" :all-data="$allData"/>
                    @endif

                    @if(issetArr($config,'googleAddress',false))
                        <x-admin.hmtl.info-div t="latitude" :des="$address->latitude" col="3" col-row="col-6" :all-data="$allData"/>
                        <x-admin.hmtl.info-div t="longitude" :des="$address->longitude" col="3" col-row="col-6" :all-data="$allData"/>
                    @endif

                </div>
            @endif
        @endforeach
    @endif
@endif










