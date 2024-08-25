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
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <x-admin.hmtl.info-div-list n="mobile" :row="$row->customer" col="col-lg-4 col-6"/>
                <x-admin.hmtl.info-div-list n="mobile_2" :row="$row->customer" col="col-lg-4 col-6"/>
                <x-admin.hmtl.info-div-list n="phone" :row="$row->customer" col="col-lg-4 col-6"/>
            </div>
            @foreach($row->customer->address as $address)
                <div class="row">
                    <x-admin.hmtl.info-div-list n="address" :row="$address" col="col-lg-12 col-12"/>
                </div>
                <div class="row">
                    <x-admin.hmtl.info-div-list n="city_id" :row="$address" col="col-lg-6 col-6"/>
                    <x-admin.hmtl.info-div-list n="area_id" :row="$address" col="col-lg-6 col-6"/>
                    <x-admin.hmtl.info-div-list n="unit_num" :row="$address" col="col-lg-4 col-6"/>
                    <x-admin.hmtl.info-div-list n="floor" :row="$address" col="col-lg-4 col-6"/>
                </div>
            @endforeach
            <div class="row">
                <x-admin.hmtl.info-div-list n="notes_err" :row="$row" col="col-lg-12 col-12"/>
                <x-admin.hmtl.info-div-list n="notes" :row="$row" col="col-lg-12 col-12"/>
                @canany(['crm_tech_follow_admin', 'crm_tech_follow_team_leader'])
                    <x-admin.hmtl.info-div-list n="user_id" :row="$row" col="col-lg-12 col-12"/>
                @endcan
            </div>

            <div class="row">
                <x-admin.hmtl.info-div-list n="created_at" :row="$row" col="col-lg-6 col-6"/>
                <x-admin.hmtl.info-div-list n="follow_date" :row="$row" col="col-lg-6 col-6"/>
            </div>

            <div class="row">
                <x-admin.hmtl.info-div-list n="open_type" :row="$row" col="col-lg-6 col-6"/>
                <x-admin.hmtl.info-div-list n="follow_state" :row="$row" col="col-lg-6 col-6"/>
                <x-admin.hmtl.info-div-list n="device_id" :row="$row" col="col-lg-6 col-6"/>
                <x-admin.hmtl.info-div-list n="brand_id" :row="$row" col="col-lg-6 col-6"/>
            </div>

            <div class="row text-center follow_action_but py-2">
                <a href="tel:{{$row->customer->mobile}}" class="btn btn-sm btn-dark"><i class="fas fa-phone-volume"></i> {{__('admin/crm.but_call')}}</a>
                <a href="{{TicketSendWhatsapp($row)}}" target="_blank" class="btn btn-sm btn-whatsapp"><i class="fab fa-whatsapp"></i> {{__('admin/crm.but_whatsapp')}}</a>
                <a href="{{route($PrefixRoute.'.UpdateTicket',$row->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-random"></i> {{__('admin/crm.but_update')}}</a>
            </div>
        </div>
    </div>
</div>
