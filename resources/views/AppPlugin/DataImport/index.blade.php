@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.main.filter-form-data form-name="{{$formName}}" :row="$rowData" :country-id="false"/>
        <x-admin.card.def :page-data="$pageData">


            <table {!!Table_Style(true,true) !!} >
                <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Full Number</th>
{{--                    <th>ISO3</th>--}}
{{--                    <th>Code</th>--}}
{{--                    <th>Symbol</th>--}}
{{--                    <th class="TD_100">{{__('admin/dataCountry.t_name')}}</th>--}}
{{--                    <th class="TD_100">{{__('admin/dataCountry.t_capital')}}</th>--}}
{{--                    <th class="TD_100">{{__('admin/dataCountry.t_currency')}}</th>--}}
{{--                    <th class="TD_100">{{__('admin/dataCountry.t_continent')}}</th>--}}
{{--                    <x-admin.table.action-but po="top" type="edit"/>--}}
{{--                    <x-admin.table.action-but po="top" type="edit"/>--}}
{{--                    <x-admin.table.action-but po="top" type="delete"/>--}}

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
{{--    <x-admin.ajax.update-status-but-code url="{{ route($PrefixRoute.'.updateStatus') }}"/>--}}
    <x-admin.data-table.plugins :jscode="true" :is-active="true"/>
    <script type="text/javascript">
        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 50,
                @include('datatable.lang')
                ajax: "{{ route( "admin.ListImport.DataTable") }}",

                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'id', name: 'id',  orderable: true, searchable: true},
                    {data: 'Flag', name: 'Flag', orderable: false, searchable: false ,className: "text_center"},
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'phone', name: 'config_data_import.phone',orderable: true, searchable: true, className: "dir_left"},
                    {data: 'full_number', name: 'config_data_import.full_number',orderable: true, searchable: true, className: "dir_left"},

                    {{--{data: 'iso3', name: 'iso3', orderable: true, searchable: true},--}}
                    {{--{data: 'phone', name: 'phone', orderable: true, searchable: true},--}}
                    {{--{data: 'symbol', name: 'symbol', orderable: true, searchable: true},--}}
                    {{--{data: 'name', name: 'data_country_translations.name', orderable: true},--}}
                    {{--{data: 'capital_name', name: 'capital_name', orderable: true, searchable: true},--}}
                    {{--{data: 'currency_name', name: 'currency_name', orderable: true, searchable: true},--}}
                    {{--{data: 'continent_name', name: 'continent_name', orderable: true, searchable: true},--}}


                    {{--    @can($PrefixRole.'_edit')--}}

                    {{--{data: 'Edit', name: 'Edit', orderable: false, searchable: false},--}}
                    {{--    @endcan--}}

                    {{--    @can($PrefixRole.'_delete')--}}

                    {{--{--}}
                    {{--    data: 'Delete', name: 'Delete', orderable: false, searchable: false--}}
                    {{--},--}}

                    {{--@endcan--}}
                ],

            });
        });
    </script>
@endpush
