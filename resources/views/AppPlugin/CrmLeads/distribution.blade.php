@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        @if(count($rowData)>0)
            <x-app-plugin.crm.leads.form-filter form-name="{{$formName}}" :row="$rowData" :config="$Config"/>
        @endif
        <form name="myform" action="{{route('admin.CrmLeads.addToUser')}}" method="post">
            @csrf

            <x-admin.card.normal :page-data="$pageData" :full-error="true" :title="$pageData['BoxH1']">
                @if(count($rowData)>0)
                    @if($errors->has([]))
                        <div class="alert alert-danger alert-dismissible">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    <div class="row">
                        <x-app-plugin.crm.leads.user-select :col-mobile="8" type="tech" :labelview="false" :req="true"/>
                        <div class="col">
                            <button type="submit" name="B1" class="btn btn-primary but_add_to_user adminButMobile float-left"><i class="fas fa-user-plus"></i> {{__('admin/crm/leads.but_add_to_user')}}</button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table {!! Table_Style_Normal()  !!} >
                            <thead>
                            <tr>

                                <th class="TD_100">{{__('admin/crm/ticket.var_date_add')}}</th>
                                <th>{{__('admin/crm/ticket.fr_follow_date')}}</th>
                                <th>{{__('admin/crm/customers.form_name')}}</th>
                                <th>{{__('admin/crm/customers.form_mobile')}}</th>
                                <th>{{__('admin/crm/customers.form_ad_area')}}</th>
                                <th>{{__('admin/crm/ticket.fr_lead_divce')}}</th>
                                <th>{{__('admin/crm/ticket.fr_notes_err')}}</th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                                <x-admin.table.action-but po="top" type="selectAll"/>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rowData as $row)
                                <tr>
                                    <td data-th="{{__('admin/crm/ticket.var_date_add')}}">{{ PrintDate($row->created_at)}}</td>
                                    <td data-th="{{__('admin/crm/ticket.fr_follow_date')}}">{{PrintDate($row->follow_date)}}</td>
                                    <td data-th="{{__('admin/crm/customers.form_name')}}">{{$row->customer->name ?? ''}}</td>
                                    <td data-th="{{__('admin/crm/customers.form_mobile')}}">{{$row->customer->mobile ?? ''}}</td>
                                    <td data-th="{{__('admin/crm/customers.form_ad_area')}}">{{ LoadConfigName($CashAreaList,$row->customer->address->first()->area_id)}}</td>
                                    <td data-th="{{__('admin/crm/ticket.fr_lead_divce')}}">{{ LoadConfigName($CashConfigDataList,$row->device_id)}}</td>
                                    <td data-th="{{__('admin/crm/ticket.fr_notes_err')}}">{{$row->notes_err}}</td>
                                    <td class="td_action">
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_{{$row->id}}"><i class="fas fa-eye"></i></button>
                                    </td>
                                    <x-app-plugin.crm.leads.popup-lead-info :id="$row->id" :config="$Config" :row="$row"/>
                                    <x-admin.table.action-but type="edit" :row="$row"/>
                                    <x-admin.table.action-but type="delete" :row="$row"/>
                                    <x-admin.table.action-but type="selectAll" :row="$row"/>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-admin.hmtl.pages-link :row="$rowData"/>
                @else
                    <x-admin.hmtl.alert-massage type="nodata"/>
                @endif

            </x-admin.card.normal>
        </form>


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.select-all-table/>
@endpush

