@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_20">#</th>
                            <th class="TD_100">اسم العرض</th>
                            <th class="TD_100">العلامة التجارية</th>
                            <th class="TD_100">عدد المنتجات</th>
                            <th class="TD_20">Soft View</th>
                            <th class="TD_20"></th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td class="tc">{!! TablePhoto($row,'photo') !!} </td>
                                <td>{{$row->name ?? ''}}</td>
                                <td>{{$row->barnd->name ?? ''}}</td>
                                <td>{{ count($row->product_id)}}</td>
                                <td>{!! is_active($row->is_soft) !!}</td>
                                <td>{!! is_active($row->is_active) !!}</td>
                                <x-admin.table.action-but type="edit" :row="$row"/>
                                <x-admin.table.action-but type="delete" :row="$row"/>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData"/>

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush

