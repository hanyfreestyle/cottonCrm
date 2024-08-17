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
                    <th class="TD_20">#</th>
                    <x-admin.table.action-but res="d" po="top" type="deleted_at" :view-but="true"/>
                    <th>{{DefCategoryTextName(IsConfig($config, 'LangPostDefName',null))}}</th>
                    <x-admin.table.action-but po="top" type="empty"/>
                    <x-admin.table.action-but po="top" type="empty"/>
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
                pageLength: {{$yajraPerPage}},
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTableSoftDeletes") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                        @include('datatable.index_action_but',['type'=> 'deleted_at','view'=> true])
                    {
                        data: 'name', name: '{{$config['DbCategoryTrans']}}.name', orderable: true, searchable: true
                    },
                    @include('datatable.index_action_but',['type'=> 'Restore'])
                    @include('datatable.index_action_but',['type'=> 'ForceDelete'])
                ],
            });
        });
    </script>

@endpush

