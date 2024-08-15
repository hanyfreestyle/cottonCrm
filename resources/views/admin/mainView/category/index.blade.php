@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    @include('admin.mainView.category.inc_but_sort')

    <x-admin.hmtl.section>
        @include('admin.mainView.category.inc_but_breadcrumb')
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <x-admin.table.action-but po="top" type="photo" res="all" :view-but="IsConfig($config, 'categoryPhotoView')"/>
                    <th>{{DefCategoryTextName(IsConfig($config, 'LangCategoryDefName',null))}}</th>
                    <x-admin.table.action-but po="top" type="isActive"/>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete" :view-but="IsConfig($config, 'categoryDelete')"/>
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
                ajax: "{{ route( $PrefixRoute.$route , $id) }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                        @include('datatable.index_action_but',['type'=> 'photo','view'=> IsConfig($config, 'categoryPhotoView')])
                    {
                        data: 'name', name: '{{$config['DbCategoryTrans']}}.name', orderable: true, searchable: true
                    },
                    @include('datatable.index_action_but',['type'=> 'isActive'])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> IsConfig($config, 'categoryDelete')])
                ],
            });
        });
    </script>
@endpush
