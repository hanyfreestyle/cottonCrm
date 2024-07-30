@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="false"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style(false,false)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_200">{{__('admin/crm/customers.form_name')}}</th>
                            <th class="TD_100">{{__('admin/crm/customers.form_mobile')}}</th>
                            <th class="TD_100">{{__('admin/crm/customers.form_mobile_2')}}</th>
                            <th class="TD_100">{{__('admin/crm/customers.form_phone')}}</th>
                            <th class="TD_100">{{__('admin/crm/customers.form_whatsapp')}}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->mobile}}</td>
                                <td>{{$row->mobile_2}}</td>
                                <td>{{$row->phone}}</td>
                                <td>{{$row->whatsapp}}</td>
                                <x-admin.table.action-but type="edit" :row="$row"/>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')

@endpush

