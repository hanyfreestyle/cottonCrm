@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.main.filter-form-data form-name="{{$formName}}" :row="$rowData" :continent="true"/>
        <x-admin.card.def :page-data="$pageData">


            <table {!!Table_Style(true,true) !!} >
                <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>ISO2</th>
                    <th>ISO3</th>
                    <th>Code</th>
                    <th>Symbol</th>
                    <th class="TD_100">{{__('admin/dataCountry.t_name')}}</th>
                    <th class="TD_100">{{__('admin/dataCountry.t_capital')}}</th>
                    <th class="TD_100">{{__('admin/dataCountry.t_currency')}}</th>
                    <th class="TD_100">{{__('admin/dataCountry.t_continent')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>

                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


        </x-admin.card.def>


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.data-table.sweet-dalete/>
    <x-admin.ajax.update-status-but-code url="{{ route($PrefixRoute.'.updateStatus') }}"/>
    <x-admin.data-table.plugins :jscode="true" :is-active="true"/>
    <script type="text/javascript">
        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [10, 'desc'],
                // columnDefs: [
                //     {"targets": 0, "className": "text-center"},
                //
                // ],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'Flag', name: 'Flag', orderable: false, searchable: false,className: "text-center"},
                    {data: 'iso2', name: 'iso2', orderable: true, searchable: true},
                    {data: 'iso3', name: 'iso3', orderable: true, searchable: true},
                    {data: 'phone', name: 'phone', orderable: true, searchable: true},
                    {data: 'symbol', name: 'symbol', orderable: true, searchable: true},
                    {data: 'name', name: 'data_country_translations.name', orderable: true,searchable: true},
                    {data: 'capital', name: 'data_country_translations.capital', orderable: true, searchable: true},
                    {data: 'currency', name: 'data_country_translations.currency', orderable: true, searchable: true},
                    {data: 'continent_name', name: 'continent_name', orderable: true, searchable: false},


                        @can($PrefixRole.'_edit')
                    {
                        data: 'is_active', name: 'is_active', orderable: true, searchable: false
                    },
                    {data: 'Edit', name: 'Edit', orderable: false, searchable: false},
                        @endcan

                        @can($PrefixRole.'_delete')

                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false
                    },

                    @endcan
                ],

            });
        });
    </script>
@endpush
