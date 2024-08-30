@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-12 dir_button">
                @can($PrefixRole.'_edit')
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.edit',$rowData->id)}}" :tip="false" type="edit"/>
                @endcan
                @can('crm_service_leads_add')
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.addTicket',$rowData->id)}}" :tip="false" type="addTicket"/>
                @endcan
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="__($defLang.'box_profile')" :collapsed="false">
            <x-app-plugin.crm.customers.card-profile :row="$rowData" :all-data="true" :soft-data="false" :config="$config"/>
        </x-admin.card.collapsed>
    </x-admin.hmtl.section>


    @if(count($card) > 0 )
        <x-admin.hmtl.section>
            <div class="row customer.profile_card">
                <x-admin.dashboard.color-card :count="$card['Open']" col="col-lg-2 col-6" :title="__('admin/crm_customer.profile_card_1')" icon="fas fa-tools" bg="p"/>
                <x-admin.dashboard.color-card :count="$card['Finished']" col="col-lg-2 col-6" :title="__('admin/crm_customer.profile_card_2')" icon="fas fa-thumbs-up" bg="s"/>
                @if($card['Reopen'] != 0)
                    <x-admin.dashboard.color-card :count="$card['Reopen']" col="col-lg-2 col-6" :title="__('admin/crm_customer.profile_card_3')" icon="fas fa-undo-alt" bg="w"/>
                @endif
                @if($card['Reject'] != 0)
                    <x-admin.dashboard.color-card :count="$card['Reject']" col="col-lg-2 col-6" :title="__('admin/crm_customer.profile_card_4')" icon="fas fa-times-circle" bg="d"/>
                @endif
                @if($card['Cancellation'] != 0)
                    <x-admin.dashboard.color-card :count="$card['Cancellation']" col="col-lg-2 col-6" :title="__('admin/crm_customer.profile_card_5')" icon="fas fa-thumbs-down" bg="d"/>
                @endif
                @if($card['Cash'] != 0)
                    <x-admin.dashboard.color-card :count="$card['Cash']" col="col-lg-2 col-6" :title="__('admin/crm_customer.profile_card_6')" icon="fas fa-file-invoice-dollar"
                                                  bg="dark"/>
                @endif
            </div>
        </x-admin.hmtl.section>
    @endif

    @if(count($OldTickets) > 0 )
        <x-admin.hmtl.section>
            <x-admin.card.normal>
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style_Normal('distribution_table')  !!} >
                        <thead>
                        <tr>
                            <th>{{__('admin/crm.label_date_add')}}</th>
                            <th>{{__('admin/crm.label_date_closed')}}</th>
                            <th>{{__('admin/crm_service.label_user_id')}}</th>
                            <th>{{__('admin/crm_service.label_device')}}</th>
                            <th>{{__('admin/crm_service.label_notes_err')}}</th>
                            <th>{{__('admin/def.status')}}</th>
                            <th>{{__('admin/crm_service_cash.label_amount')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($OldTickets as $row)
                            <tr>
                                <td class="hideForMobile" data-th="{{__('admin/crm.label_date_add')}}">{{ PrintDate($row->created_at)}}</td>
                                <td class="hideForMobile" data-th="{{__('admin/crm.label_date_closed')}}">{{ checkClosedDate($row) }}</td>
                                <td data-th="{{__('admin/crm.label_user_id')}}">{{$row->user->name ?? ''}}</td>
                                <td class="hideForMobile" data-th="{{__('admin/crm_service.label_device')}}">{{ LoadConfigName($CashConfigDataList,$row->device_id)}}</td>
                                <td class="hideForMobile" data-th="{{__('admin/crm_service.label_notes_err')}}">{{$row->notes_err}}</td>

                                <td data-th="{{__('admin/crm.label_customer_mobile')}}">{{ LoadConfigName($DefCat['CrmServiceTicketState'], $row->follow_state)}}</td>
                                <td data-th="{{__('admin/crm_service_cash.label_amount')}}">{{ number_format($row->customer_amount_sum_amount)  }}</td>
                                <td class="td_action">
                                    <button type='button' class='btn btn-sm btn-dark adminButMobile' data-toggle='modal' data-target='#modal_{{$row->id}}'>
                                        <span class="tipName"></span> <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <x-admin.hmtl.popup-modal id="modal_{{$row->id}}" :title="__('admin/crm.model_title_info')">
                                    <x-app-plugin.crm-service.leads.lead-info-closed :row="$row"/>
                                    <x-app-plugin.crm-service.leads.lead-info :add-title="true" :row="$row"/>
                                </x-admin.hmtl.popup-modal>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card.normal>
        </x-admin.hmtl.section>
    @endif

    <div class="mb-5 pb-5"></div>
@endsection
