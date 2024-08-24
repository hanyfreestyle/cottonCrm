@if($n == 'name')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-user-tie" :t="__('admin/crm_customer.form_name')"
                           :des="$row->name" :col="$col" :all-data="$allData"/>

@elseif($n =='mobile')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-mobile-alt" s="number" :t="__('admin/crm_customer.form_mobile')"
                           :des="$row->mobile" :col="$col" :all-data="$allData"/>

@elseif($n=='mobile_2')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-mobile-alt" s="number" :t="__('admin/crm_customer.form_mobile_2')"
                           :des="$row->mobile_2" :col="$col" :all-data="$allData"/>

@elseif($n=='phone')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-phone-square" s="number" :t="__('admin/crm_customer.form_phone')"
                           :des="$row->phone" :col="$col" :all-data="$allData"/>

@elseif($n=='whatsapp')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fab fa-whatsapp" s="number" :t="__('admin/crm_customer.form_whatsapp')"
                           :des="$row->whatsapp" :col="$col" :all-data="$allData"/>
@elseif($n=='country_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-globe-americas" :t="__('admin/crm_customer.form_ad_country')" :arr-data="$CashCountryList"
                           :des="$row->country_id" :col="$col" :all-data="$allData"/>
@elseif($n=='city_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-flag" :t="__('admin/crm_customer.form_ad_city')" :arr-data="$CashCityList"
                           :des="$row->city_id" :col="$col" :all-data="$allData"/>
@elseif($n=='area_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-map-pin" :t="__('admin/crm_customer.form_ad_area')" :arr-data="$CashAreaList"
                           :des="$row->area_id" :col="$col" :all-data="$allData"/>
@elseif($n=='address')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-hotel" :t="__('admin/crm_customer.form_ad_address')"
                           :des="$row->address" :col="$col" :all-data="$allData"/>

@elseif($n=='unit_num')
    <x-admin.hmtl.info-div :sub-des="true" i="fas fa-couch" :t="__('admin/crm_customer.form_ad_unit_num')"
                           :des="$row->unit_num" :col="$col" :all-data="$allData"/>
@elseif($n=='floor')
    <x-admin.hmtl.info-div :sub-des="true" i="fas fa-layer-group" :t="__('admin/crm_customer.form_ad_floor')"
                           :des="$row->floor" :col="$col" :all-data="$allData"/>

@elseif($n=='latitude')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-street-view" t="latitude" s="semi_number"
                           des="[{{$row->latitude.' , '.$row->longitude}}]" :col="$col" :all-data="$allData"/>

@elseif($n=='evaluation_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-star" :t="__('admin/crm_customer.form_evaluation')" :arr-data="$CashConfigDataList"
                           :des="$row->evaluation_id" :col="$col" :all-data="$allData"/>
@elseif($n=='gender_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-restroom" :t="__('admin/crm_customer.form_gender')" :arr-data="$DefCat['gender']"
                           :des="$row->gender_id" :col="$col" :all-data="$allData"/>
@elseif($n=='email')

    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-at" :t="__('admin/crm_customer.form_email')" s="semi_number"
                           :des="$row->email" :col="$col" :all-data="$allData"/>
@elseif($n=='post_code')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-inbox" :t="__('admin/crm_customer.form_ad_post_code')"
                           :des="$row->post_code" :col="$col" :all-data="$allData"/>

@elseif($n=='created_at')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-calendar-alt" :t="__('admin/crm.label_date_add')"
                           :des="PrintDate($row->created_at)" :col="$col" :all-data="$allData"/>

@elseif($n=='follow_date')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-tools" :t="__('admin/crm.label_date_follow')"
                           :des="PrintDate($row->follow_date)" :col="$col" :all-data="$allData"/>
@elseif($n=='user_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-user-cog"  :sub-des="true" :t="__('admin/crm/ticket.fr_user_id')" :arr-data="$CashUsersList"
                           :des="$row->user_id" :col="$col" :all-data="$allData"/>

@elseif($n=='open_type')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-eye" :t="__('admin/crm/ticket.var_open_type')" :arr-data="$DefCat['TicketOpenType']"
                           :des="$row->open_type" :col="$col" :all-data="$allData"/>

@elseif($n=='follow_state')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-tag" :t="__('admin/crm/ticket.var_ticket_state')" :arr-data="$DefCat['TicketState']"
                           :des="$row->follow_state" :col="$col" :all-data="$allData"/>

@elseif($n=='sours_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-filter" :t="__('admin/crm/ticket.fr_lead_sours')" :arr-data="$CashConfigDataList"
                           :des="$row->sours_id" :col="$col" :all-data="$allData"/>

@elseif($n=='ads_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fab fa-google" :t="__('admin/crm/ticket.fr_lead_ads')" :arr-data="$CashConfigDataList"
                           :des="$row->ads_id" :col="$col" :all-data="$allData"/>

@elseif($n=='device_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-desktop" :t="__('admin/crm_service.label_device')" :arr-data="$CashConfigDataList"
                           :des="$row->device_id" :col="$col" :all-data="$allData"/>

@elseif($n=='brand_id')
    <x-admin.hmtl.info-div :v-type="$viewList" i="fas fa-copyright" :t="__('admin/crm/ticket.fr_lead_brand')" :arr-data="$CashConfigDataList"
                           :des="$row->brand_id" :col="$col" :all-data="$allData"/>

@elseif($n=='notes_err')
    <x-admin.hmtl.info-div i="fas fa-exclamation-triangle"  :t="__('admin/crm_service.label_notes_err')"
                           :des="$row->notes_err" :col="$col" :all-data="$allData"/>
@elseif($n=='notes')

    <x-admin.hmtl.info-div i="fas fa-bullhorn" :t="__('admin/crm.label_notes')"
                           :des="$row->notes" :col="$col" :all-data="$allData"/>
@elseif($n=='XXXXXX')
@elseif($n=='XXXXXX')

@elseif($n=='XXXXXX')

@endif



