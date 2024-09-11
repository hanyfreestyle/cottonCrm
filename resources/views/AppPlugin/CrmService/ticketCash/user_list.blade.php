@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="col-lg-12">
            <x-app-plugin.crm-service.cash.users-filter form-name="{{$formName}}"/>
        </div>
        <div class="col-lg-12">
            @if(count($closedTicket)>0)
                @foreach($closedTicket as $key => $closedState)
                    @php
                        $amount  = 0 ;
                        $amountPay  = 0 ;
                        $amountNotPay  = 0 ;
                    @endphp
                    <div class="row">
                        <div class="col-lg-12">
                            {!! returnClosedForUser($key) !!}
                        </div>
                        <div class="col-lg-12">
                            <table {!! Table_Style_Normal() !!} >
                                <thead>
                                <tr>
                                    <th class="desktop">{{__('admin/crm.label_date_closed')}}</th>
                                    <th class="desktop">{{__('admin/crm.label_customer_name')}}</th>
                                    <th class="desktop">{{__('admin/crm.label_customer_area')}}</th>
                                    <th class="{{returnTableRes($agent)}}">{{__('admin/crm_service.label_device')}}</th>
                                    @if($key == 2 or $key == 6)
                                        <th>التكلفة</th>
                                        <th>محصل</th>
                                        <th>غير محصل</th>
                                        <x-admin.table.action-but po="top" res="all" type="empty"/>
                                    @endif
                                    <x-admin.table.action-but po="top" res="all" type="empty"/>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($closedState as $ticket)
                                    @php
                                        $cashInfo = returnUserCashInfo($ticket,$key);
                                    @endphp
                                    <tr>
                                        <td>{{$ticket->close_date}}</td>
                                        <td>{{$ticket->customer->name}}</td>
                                        <td>{{$ticket->customer->address->first()->area->name}}</td>
                                        <td>{{$ticket->device_name->name}}</td>
                                        @if($key == 2 or $key == 6)
                                            {!! $cashInfo['table'] !!}
                                            <x-app-plugin.crm-service.cash.users-cash-but :amount="$cashInfo['amountNotPay']" :row="$ticket" :id="$cashInfo['id']" />
                                        @endif
                                        <td class="td_action">
                                            <button type='button' class='btn btn-sm btn-dark adminButMobile' data-toggle='modal' data-target='#modal_{{$ticket->id}}'>
                                                <span class="tipName"></span> <i class="fas fa-eye"></i>
                                            </button>
                                            <x-admin.hmtl.popup-modal id="modal_{{$ticket->id}}" :title="__('admin/crm.model_title_info')">
                                                <x-app-plugin.crm.customers.card-profile :row="$ticket->customer" :add-title="true" :soft-data="true" :config="$config"/>
                                                <x-app-plugin.crm-service.leads.lead-info :add-title="true" :row="$ticket"/>
                                            </x-admin.hmtl.popup-modal>
                                        </td>
                                    </tr>

                                    @php
                                        $amount = $amount + $cashInfo['amount'] ;
                                        $amountPay = $amountPay + $cashInfo['amountPay'] ;
                                        $amountNotPay = $amountNotPay + $cashInfo['amountNotPay'] ;
                                    @endphp

                                @endforeach

                                </tbody>
                                @if($key == 2 or $key == 6)
                                    <tfoot>
                                    <tr>
                                        <td class="hideForMobile" colspan="3">&nbsp;</td>
                                        <td><strong>{{__('admin/crm_service_cash.label_sum')}}</strong></td>
                                        <td><strong>{{number_format($amount)}}</strong></td>
                                        <td><strong>{{number_format($amountPay)}}</strong></td>
                                        <td><strong>{{number_format($amountNotPay)}}</strong></td>
                                        <td class="hideForMobile">&nbsp;</td>
                                        <td class="hideForMobile">&nbsp;</td>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                @endforeach

            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </div>
    </x-admin.hmtl.section>
@endsection

