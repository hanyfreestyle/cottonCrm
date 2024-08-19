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
                    <th class="all"></th>
                    <th class="all">CatId</th>
                    <th class="desktop TD_350">{{__('admin/form.text_g_title')}}</th>
                    <th class="desktop TD_350">{{__('admin/form.text_g_des')}}</th>
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
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 10,
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.'.DataTable') }}",

                columns: [
                    {data: 'id', name: 'id', orderable: true, searchable: true},
                    {data: 'photo', name: 'photo', orderable: false, searchable: false, className: "text-center actionButView"},
                    {data: 'cat_id', name: 'cat_id', orderable: true, searchable: true},
                    {data: 'title', name: 'config_meta_tag_translations.g_title', orderable: true},
                    {data: 'des', name: 'config_meta_tag_translations.g_des', orderable: true},
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
