@extends('admin.layouts.app')

@section('StyleFile')
{{--    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>--}}
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if(count($rowData)>0)
            <x-admin.card.def :title="__('admin/proProduct.app_menu_update_price')" :page-data="$pageData">
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style(false,false)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_200">{{__('admin/proProduct.pro_text_name')}}  {{printLableKey(thisCurrentLocale())}}</th>
                            <th class="TD_100">{{__('admin/proProduct.pro_text_regular_price')}}</th>
                            <th class="TD_80">{{__('admin/proProduct.pro_text_price')}}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->regular_price}}</td>
                                <td>{{$row->price}}</td>
                                <td>
                                    <x-admin.form.action-button
                                        url="{{route('admin.Product.Product.manage-attribute',$row->id)}}"
                                        :print-lable="__('admin/proProduct.pro_variant_manage')" :tip="false"/>
                                </td>
                                <x-admin.table.action-but type="edit" :row="$row"/>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card.def>
        @endif

        @if(count($needUpdate)>0)
            <x-admin.card.def :title="__('admin/proProduct.app_menu_update_price')" :page-data="$pageData">
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style(false,false)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_200">{{__('admin/proProduct.pro_text_name')}}  {{printLableKey(thisCurrentLocale())}}</th>
                            <th class="TD_100">{{__('admin/proProduct.pro_text_regular_price')}}</th>
                            <th class="TD_80">{{__('admin/proProduct.pro_text_price')}}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($needUpdate as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->regular_price}}</td>
                                <td>{{$row->price}}</td>
                                <td>
                                    <x-admin.form.action-button
                                        url="{{route('admin.Product.Product.manage-attribute',$row->id)}}"
                                        :print-lable="__('admin/proProduct.pro_variant_manage')" :tip="false"/>
                                </td>
                                <x-admin.table.action-but type="edit" :row="$row"/>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card.def>
        @endif

        @if(count($needUpdate) == 0 and count($rowData) == 0)
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
{{--    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>--}}
@endpush

