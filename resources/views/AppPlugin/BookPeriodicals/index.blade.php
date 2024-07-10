@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
{{--        <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :country-id="true" :city-id="true" :area-id="true"/>--}}
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <table {!!Table_Style(true,true) !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_200">{{__('admin/Periodicals.form_name')}}</th>
                    <th class="TD_200">{{__('admin/Periodicals.form_name')}}</th>
                    <th class="TD_200">{{__('admin/Periodicals.form_name')}}</th>
                    <th class="TD_200">{{__('admin/Periodicals.form_name')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>
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
                pageLength: 25,
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},

                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'countryName', name: 'data_country_translations.name', orderable: true, searchable: true},
                    {data: 'releaseName', name: 'config_data_translations.name', orderable: true, searchable: true},
                    {data: 'countRell', name: 'countRell', orderable: false, searchable: false},



                        @can($PrefixRole.'_edit')
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center"
                    },
                        @endcan

                        @can($PrefixRole.'_delete')

                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center"
                    },

                    @endcan
                ],

            });
        });
    </script>
@endpush

