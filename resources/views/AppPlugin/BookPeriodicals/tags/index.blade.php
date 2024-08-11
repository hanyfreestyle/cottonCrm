@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="all">#</th>
                    <th class="all">{{__('admin/form.text_name')}}</th>
                    <th class="desktop">{{__('admin/Periodicals.form_notes_count')}}</th>
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
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'notes_count', name: 'notes_count', orderable: true, searchable: false},

                        @can($PrefixRole.'_edit')
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"
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

