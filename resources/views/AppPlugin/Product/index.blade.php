@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.product.filter :row="$rowData" form-name="{{$formName}}" :def-route="$filterRoute" :only-data-table="true"/>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style(true,true)  !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_20"></th>
                    <th class="TD_200">{{__('admin/proProduct.pro_text_name')}}</th>
                    <th class="TD_100">{{__('admin/proProduct.cat_text_name')}}</th>
                    <th class="TD_100">{{__('admin/proProduct.app_menu_brand')}}</th>
                    <th class="TD_100">{{__('admin/proProduct.pro_text_regular_price')}}</th>
                    <th class="TD_80">{{__('admin/proProduct.pro_text_price')}}</th>
                    @if($Config['TableAddLang'] and count(config('app.web_lang')) > 1)
                        <x-admin.table.action-but po="top" type="addLang"/>
                    @endif
                    @if($pageData['ViewType'] == 'deleteList')
                        <x-admin.table.soft-delete/>
                    @else
                        <th class="td_action"></th>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="delete"/>
                    @endif
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </x-admin.card.def>


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.data-table.sweet-dalete/>
    <x-admin.data-table.plugins :jscode="true" :is-active="true"/>
    <script type="text/javascript">

        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [0, 'desc'],

                @include('datatable.lang')
                ajax: "{{ $route }}",


                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo', orderable: false, searchable: false, className: "text-center"},
                    {data: 'tablename.0.name', name: 'tablename.name'},
                    {
                        data: 'CatNameNoSlug', name: 'CatNameNoSlug', orderable: false, searchable: false
                    },
                    {
                        data: 'Brand', name: 'Brand', orderable: false, searchable: false
                    },

                    {
                        data: 'regular_price', name: 'regular_price', orderable: true, searchable: true,
                    },

                    {
                        data: 'price', name: 'price', orderable: true, searchable: true,
                    },

                        @if($pageData['ViewType'] == 'deleteList')
                    {
                        'name': 'deleted_at',
                        'data': {
                            '_': 'deleted_at.display',
                            'sort': 'deleted_at.timestamp'
                        }
                    },
                    {
                        data: 'Restore', name: 'Restore', orderable: false, searchable: false, className: "text-center"
                    },
                    {
                        data: 'ForceDelete', name: 'ForceDelete', orderable: false, searchable: false, className: "text-center"
                    },
                        @else

                    {
                        data: 'is_active', name: 'is_active', orderable: false, searchable: false, className: "text-center"
                    },

                        @can($PrefixRole.'_edit')
                        @if($Config['TableAddLang'] and count(config('app.web_lang')) > 1)
                    {
                        data: 'AddLang', name: 'AddLang', orderable: false, searchable: false, className: "text-center"
                    },
                        @endif
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center"
                    },
                        @endcan
                        @can($PrefixRole.'_delete')
                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center"
                    },
                    @endcan
                    @endif


                ],

            });
        });
    </script>
@endpush

