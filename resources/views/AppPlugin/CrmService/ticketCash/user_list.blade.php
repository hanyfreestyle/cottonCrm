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
                                    <th>{{__('admin/crm_customer.profile_card_6')}}</th>
                                    <x-admin.table.action-but po="top" type="delete"/>
                                    <x-admin.table.action-but po="top" res="all" type="empty"/>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($closedState as $ticket)
                                    <tr>
                                        <td>{{$ticket->close_date}}</td>
                                        <td>{{$ticket->customer->name}}</td>
                                        <td>{{$ticket->customer->address->first()->area->name}}</td>
                                        <td>{{$ticket->device_name->name}}</td>
                                        <td>{{$ticket->cashData->where('follow_state',$key)->first()->id ?? null}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
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

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
@endpush

