@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.main.filter-form-data form-name="{{$formName}}" :row="$rowData" :continent="true"/>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="all">#</th>
                    <th class="all"></th>
                    <th class="desktop">ISO2</th>
                    <th class="desktop">ISO3</th>
                    <th class="desktop">Code</th>
                    <th class="desktop">Symbol</th>
                    <th class="all">{{__('admin/dataCountry.t_name')}}</th>
                    <th class="desktop">{{__('admin/dataCountry.t_capital')}}</th>
                    <th class="desktop">{{__('admin/dataCountry.t_currency')}}</th>
                    <th class="desktop">{{__('admin/dataCountry.t_continent')}}</th>
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
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                responsive: true,
                order: [10, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'Flag', name: 'Flag', orderable: false, searchable: false, className: "text-center"},
                    {data: 'iso2', name: 'iso2', orderable: true, searchable: true},
                    {data: 'iso3', name: 'iso3', orderable: true, searchable: true},
                    {data: 'phone', name: 'phone', orderable: true, searchable: true},
                    {data: 'symbol', name: 'symbol', orderable: true, searchable: true},
                    {data: 'name', name: 'data_country_translations.name', orderable: true, searchable: true},
                    {data: 'capital', name: 'data_country_translations.capital', orderable: true, searchable: true},
                    {data: 'currency', name: 'data_country_translations.currency', orderable: true, searchable: true},
                    {data: 'continent_name', name: 'continent_name', orderable: true, searchable: false},

                        @can($PrefixRole.'_edit')
                    {
                        data: 'is_active', name: 'is_active', orderable: true, searchable: false, className: "text-center actionButView"
                    },
                    {data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"},
                        @endcan

                        @can($PrefixRole.'_delete')

                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center actionButView"
                    },

                    @endcan
                ],

            });
        });
    </script>
@endpush
