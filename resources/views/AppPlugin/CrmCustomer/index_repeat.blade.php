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
                        @include('AppPlugin.CrmCustomer.index_header')
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td></td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->mobile}}</td>
                                <td>{{$row->phone}}</td>
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
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="false"/>
@endpush

