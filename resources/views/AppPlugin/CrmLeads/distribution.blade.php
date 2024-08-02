@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style_Normal()  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th>{{__($defLang.'t_date_add')}}</th>
                            <th>{{__($defLang.'t_date_follow')}}</th>
                            <th>{{__($defLang.'t_cust_name')}}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td data-th="#">{{$row->id}}</td>
                                <td data-th="{{__($defLang.'t_date_add')}}">{{ PrintDate($row->created_at)}}</td>
                                <td data-th="{{__($defLang.'t_date_follow')}}">{{PrintDate($row->follow_date)}}</td>
                                <td data-th="{{__($defLang.'t_cust_name')}}">{{$row->customer->name}}</td>
                                <td><button type="button" class="btn btn-default" data-toggle="modal"  data-target="#modal_{{$row->id}}"><i class="fas fa-eye"></i></button></td>
                                <x-app-plugin.crm.leads.popup-lead-info :id="$row->id" :config="$Config" :row="$row"/>

                                <x-admin.table.action-but type="edit" :row="$row" />
                                <x-admin.table.action-but type="delete" :row="$row" />
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <x-admin.hmtl.pages-link :row="$rowData"/>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif

        </x-admin.card.def>


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
@endpush

