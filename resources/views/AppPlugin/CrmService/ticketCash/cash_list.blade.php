@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="col-lg-12">
            <x-app-plugin.crm-service.cash.form-filter form-name="{{$formName}}" :row="$rowData"/>
        </div>
        @if(count($rowData)>0)
            @foreach($rowData as $date => $datevalue)
                <x-admin.card.normal :page-data="$pageData" :full-error="true" title="{{ __('admin/crm_service_cash.box_for_day').' '.$date }}">
                    <x-admin.form.print-error-div :full-err="true"/>
                    <div class="card-body table-responsive p-0">
                        <table {!! Table_Style_Normal('distribution_table')  !!} >
                            <thead>
                            <tr>
                                <th>{{__('admin/crm_service_cash.label_date_pay')}}</th>
                                <th>{{__('admin/crm.label_customer_name')}}</th>
                                <th>{{__('admin/crm_service.label_user_id')}}</th>
                                <th>{{__('admin/crm_service_cash.label_amount_type')}}</th>
                                <th>{{__('admin/crm_service_cash.label_amount')}}</th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datevalue as $row)
                                <tr>
                                    <td data-th="{{__('admin/crm_service_cash.label_date_pay')}}">{{PrintDate($row->ticket->close_date)}}</td>
                                    <td data-th="{{__('admin/crm.label_customer_name')}}">{{$row->customer->name ?? ''}}</td>
                                    <td data-th="{{__('admin/crm_service.label_user_id')}}">{{$row->user->name ?? ''}}</td>
                                    <td data-th="{{__('admin/crm_service_cash.label_amount_type')}}">{{ LoadConfigName($DefCat['CrmServiceCashType'],$row->amount_type)}}</td>
                                    <td data-th="{{__('admin/crm_service_cash.label_amount')}}">{{number_format($row->amount)}}</td>
                                    <td class="td_action">
                                        <button type='button' class='btn btn-sm btn-dark adminButMobile' data-toggle='modal' data-target='#modal_{{$row->id}}'>
                                            <i class="fas fa-eye"></i> <span class="tipName">{{__('admin/crm_service_cash.label_notes')}}</span>
                                        </button>
                                    </td>
                                    <x-admin.hmtl.popup-modal id="modal_{{$row->id}}" :title="__('admin/crm.model_title_info')">
                                        <x-app-plugin.crm.customers.card-profile :row="$row->customer" :add-title="true" :soft-data="true" :config="$config"/>
                                        <x-app-plugin.crm-service.leads.lead-info :add-title="true" :row="$row->ticket"/>
                                    </x-admin.hmtl.popup-modal>
                                    <x-admin.table.action-but type="delete" :row="$row"/>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <td class="hideForMobile" colspan="3">&nbsp;</td>
                                <td><strong>{{__('admin/crm_service_cash.label_sum')}}</strong></td>
                                <td><strong>{{number_format($datevalue->sum('amount'))}}</strong></td>
                                <td class="hideForMobile" >&nbsp;</td>
                                <td class="hideForMobile" >&nbsp;</td>
                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </x-admin.card.normal>

            @endforeach



        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.select-all-table/>
@endpush

