@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-app-plugin.crm.book.form-filter form-name="{{$formName}}" :row="$rowData"/>
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class=" all">#</th>
                    <th class=" all">{{__('admin/Periodicals.form_name')}}</th>
                    <th class=" desktop">{{__('admin/Periodicals.form_des')}}</th>
                    <th class=" desktop">{{__('admin/Periodicals.form_country')}}</th>
                    <th class=" desktop">{{__('admin/Periodicals.form_lang')}}</th>
                    <th class=" desktop">{{__('admin/Periodicals.form_release_name')}}</th>
                    <th class=" desktop">{{__('admin/Periodicals.form_release_count')}}</th>
                    <th class=" desktop">{{__('admin/Periodicals.form_release_repeat')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="edit"/>
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
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 25,
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},

                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'des', name: 'des', orderable: true, searchable: true},
                    {data: 'countryName', name: 'data_country_translations.name', orderable: true, searchable: true , className: "text-center" },
                    {data: 'langName', name: 'lang.name', orderable: true, searchable: true , className: "text-center" },
                    {data: 'releaseName', name: 'releasetype.name', orderable: true, searchable: true , className: "text-center" },
                    {data: 'countRell', name: 'countRell', orderable: false, searchable: false, className: "text-center" },
                    {data: 'release_sum_repeat', name: 'release_sum_repeat', orderable: false, searchable: false, className: "text-center" },



                        @can($PrefixRole.'_edit')
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"

                    },
                    {
                        data: 'AddRelease', name: 'AddRelease', orderable: false, searchable: false, className: "text-center actionButView"

                    },
                    {
                        data: 'ListRelease', name: 'ListRelease', orderable: false, searchable: false, className: "text-center actionButView"

                    },
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

