<div class="col-md-3">
    <div class="card card-widget followUp_Card getCash {{$collapsed_style}}">
        <div class="card-header  {{$bg}}">
            <div class="user-block">
                <span class="username">{{$row->customer->name}}</span>
                <span class="description">
                    {{ LoadConfigName($CashConfigDataList,$row->ticket->device_id)}} -
                    {{ LoadConfigName($CashAreaList,$row->customer->address->first()->area_id)}}
                    <span class="font-weight-bold" style="font-size: 16px"> ({{number_format($row->amount)}}) </span>
                </span>
            </div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas {{$open_style}}"></i></button>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <x-admin.hmtl.info-div :sub-des="true" i="fas fa-calendar-alt" :t="__('admin/crm_service_cash.label_date_pay')" :des="PrintDate($row->created_at)" col="col-lg-12 col-12"/>
                @if($row->amount_type == 1)
                    @if(count($depositCash) == 2 )
                        @php
                            $total = 0 ;
                        @endphp
                        @foreach($depositCash as $cash)
                            @if($cash->amount_type == 2)
                                <x-admin.hmtl.info-div i="fas fa-funnel-dollar" :t="__('admin/crm_service_var.cash_type_2')" :des="number_format($cash->amount)" col="col-lg-6 col-12"
                                                       :all-data="true"/>
                            @elseif($cash->amount_type == 1)
                                <x-admin.hmtl.info-div i="fas fa-file-invoice-dollar" :t="__('admin/crm_service_var.cash_type_4')" :des="number_format($cash->amount)" col="col-lg-6 col-12"
                                                       :all-data="true"/>
                            @endif

                            @php
                                $total = $total + $cash->amount;
                            @endphp
                        @endforeach
                        <x-admin.hmtl.info-div :sub-des="true" i="fas fa-calendar-alt" :t="__('admin/crm_service_cash.label_amount')"
                                               :des="number_format($total)" col="col-lg-12 col-12"/>
                    @else
                        <x-admin.hmtl.info-div :sub-des="true" i="fas fa-calendar-alt" :t="__('admin/crm_service_cash.label_amount')"
                                               :des="number_format($row->amount)" col="col-lg-12 col-12"/>
                    @endif
                @else
                    <x-admin.hmtl.info-div :sub-des="true" i="fas fa-calendar-alt" :t="__('admin/crm_service_cash.label_amount')"
                                           :des="number_format($row->amount)" col="col-lg-12 col-12"/>
                @endif
                <x-admin.hmtl.info-div :sub-des="false" i="fas fa-comment" :t="__('admin/crm_service_cash.label_notes')"
                                       :des="$row->cashDes()->first()->des ?? '' " col="col-lg-12 col-12"/>
            </div>

            @if($showBut)
                @can('crm_service_cash_edit')
                    <div class="row text-center follow_action_but py-2">
                        <button type='button' class='btn btn-sm btn-dark adminButMobile' data-toggle='modal' data-target='#modal_{{$row->id}}'>
                            <span class="tipName"></span> <i class="fas fa-eye"></i> {{__('admin/crm_service_cash.label_notes')}}
                        </button>
                        @if($row->amount_type == '4')
                            <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.ConfirmPayBack',$row->id)}}" :tip="false" sweet-del-class="sweet_confirm_back_but_{{$row->id}}"
                                                        :l="__('admin/crm_service_cash.label_but_cash_back')" bg="d" icon="fas fa-vote-yea"/>

                        @else
                            <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.ConfirmPay',$row->id)}}" :tip="false" sweet-del-class="sweet_confirm_but_{{$row->id}}"
                                                        :l="__('admin/crm_service_cash.label_but_collection')" bg="s" icon="fas fa-vote-yea"/>
                        @endif

                    </div>
                @endcan
            @endif
        </div>
    </div>
</div>


<x-admin.hmtl.popup-modal id="modal_{{$row->id}}" :title="__('admin/crm.model_title_info')">
    <x-app-plugin.crm.customers.card-profile :row="$row->customer" :add-title="true" :soft-data="true" :config="$config"/>
    <x-app-plugin.crm-service.leads.lead-info :ticket-id="$row->ticket->id" :add-title="true"/>
</x-admin.hmtl.popup-modal>

@push('JsCode')
    <x-admin.table.sweet-confirm-js class-name="sweet_confirm_but_{{$row->id}}" icon-style="confirm_get_amount" s-text="{!! $mass !!}"/>
    <x-admin.table.sweet-confirm-js class-name="sweet_confirm_back_but_{{$row->id}}" icon-style="confirm_get_amount" s-text="{!! $mass !!}"/>
@endpush
