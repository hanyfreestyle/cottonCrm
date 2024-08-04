<div class="col-md-4">
    <div class="card card-widget followUp_Card {{$collapsed_style}}">
        <div class="card-header  {{$bg}}">
            <div class="user-block">
                <span class="username">{{$row->customer->name}}</span>
                <span class="description">
                    {{ LoadConfigName($CashConfigDataList,$row->device_id)}} -
                    {{ LoadConfigName($CashAreaList,$row->customer->address->first()->area_id)}}
                </span>
                <span class="description"><i class="far fa-clock"></i> {{ PrintDate($row->follow_date)}} {{TicketDateFrom($row->follow_date)}}</span>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas {{$open_style}}"></i></button>
                {{--                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-mobile-alt" :t="__('admin/crm/customers.form_mobile')" :des="$row->customer->mobile" col="4" col-row="col-4" :all-data="false"/>
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-mobile-alt" :t="__('admin/crm/customers.form_mobile_2')" :des="$row->customer->mobile_2" col="4" col-row="col-4" :all-data="false"/>
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-mobile-alt" :t="__('admin/crm/customers.form_phone')" :des="$row->customer->phone" col="4" col-row="col-4" :all-data="false"/>
            </div>
            @foreach($row->customer->address as $address)
                <div class="row">
                    <x-admin.hmtl.info-div v-type="icon" i="fas fa-hotel" :t="__('admin/crm/customers.form_ad_address')" :des="$address->address" col="12" col-row="col-12" :all-data="false"/>
                </div>
                <div class="row">
                    <x-admin.hmtl.info-div v-type="icon" i="fas fa-flag" :t="__('admin/crm/customers.form_ad_city')" :arr-data="$CashCityList" :des="$address->city_id" col="6" col-row="col-6"
                                           :all-data="false"/>
                    <x-admin.hmtl.info-div v-type="icon" i="fas fa-map-pin" :t="__('admin/crm/customers.form_ad_area')" :arr-data="$CashAreaList" :des="$address->area_id" col="6" col-row="col-6"
                                           :all-data="false"/>
                    <x-admin.hmtl.info-div v-type="icon" i="fas fa-couch" :t="__('admin/crm/customers.form_ad_unit_num')" :des="$address->unit_num" col="2" col-row="col-3" :all-data="false"/>
                    <x-admin.hmtl.info-div v-type="icon" i="fas fa-layer-group" :t="__('admin/crm/customers.form_ad_floor')" :des="$address->floor" col="2" col-row="col-3" :all-data="false"/>
                </div>
            @endforeach
            <div class="row">
                <x-admin.hmtl.info-div i="fas fa-exclamation-triangle" :t="__('admin/crm/ticket.fr_notes_err')" :des="$row->notes_err" col="12" col-row="col-12" :all-data="false"/>
                <x-admin.hmtl.info-div i="fas fa-bullhorn" :t="__('admin/crm/ticket.fr_notes')" :des="$row->notes" col="12" col-row="col-12" :all-data="false"/>

                @canany(['crm_tech_follow_admin', 'crm_tech_follow_team_leader'])
                    <x-admin.hmtl.info-div i="fas fa-user-cog" :t="__('admin/crm/ticket.fr_user_id')" :sub-des="true" :des="$row->user->name" col="12" col-row="col-12" :all-data="false"/>
                @endcan

            </div>
            <div class="row">
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-calendar-alt" :t="__('admin/crm/ticket.var_date_add')" :des="PrintDate($row->created_at)" col="6" col-row="col-6" :all-data="false"/>
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-tools" :t="__('admin/crm/ticket.fr_follow_date')" :des="PrintDate($row->follow_date)" col="6" col-row="col-6" :all-data="false"/>
            </div>
            <div class="row">
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-eye" :t="__('admin/crm/ticket.var_open_type')" :arr-data="$DefCat['TicketOpenType']" :des="$row->open_type" col="6" col-row="col-6"
                                       :all-data="false"/>
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-tag" :t="__('admin/crm/ticket.var_ticket_state')" :arr-data="$DefCat['TicketState']" :des="$row->follow_state" col="6" col-row="col-6"
                                       :all-data="false"/>
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-desktop" :t="__('admin/crm/ticket.fr_lead_divce')" :arr-data="$CashConfigDataList" :des="$row->device_id" col="6" col-row="col-6"/>
                <x-admin.hmtl.info-div v-type="icon" i="fas fa-copyright" :t="__('admin/crm/ticket.fr_lead_brand')" :arr-data="$CashConfigDataList" :des="$row->brand_id" col="6" col-row="col-6"/>
            </div>

            <div class="row text-center follow_action_but py-2">
                <a href="tel:{{$row->customer->mobile}}" class="btn btn-sm btn-dark"><i class="fas fa-phone-volume"></i> {{__('admin/crm/ticket.but_call')}}</a>
                <a href="{{TicketSendWhatsapp($row)}}" target="_blank" class="btn btn-sm btn-whatsapp"><i class="fab fa-whatsapp"></i> {{__('admin/crm/ticket.but_whatsapp')}}</a>
                <a href="{{route($PrefixRoute.'.ViewTicket',$row->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-random"></i> {{__('admin/crm/ticket.but_update')}}</a>
            </div>
        </div>


    </div>
</div>
