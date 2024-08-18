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
                    <x-admin.table.action-but res="d" po="top" type="photo" :view-but="IsConfig($config, 'postPhotoAdd')"/>
                    <x-admin.table.action-but res="d" po="top" type="PublishedDate" :view-but="IsConfig($config, 'postPublishedDate')"/>
                    <x-admin.table.action-but res="d" po="top" type="UserName" :view-but="true"/>
                    <th>{{DefCategoryTextName(IsConfig($config, 'LangPostDefName',null))}}</th>
                    <x-admin.table.action-but res="d" po="top" type="CategoryName" :view-but="IsConfig($config, 'TableCategory')"/>
                    <x-admin.table.action-but res="d" po="top" type="isActive"/>
                    <x-admin.table.action-but po="top" type="morePhoto"/>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete" :view-but="true"/>
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
                    {{--ajax: "{{ route( $PrefixRoute.$route , $id) }}",--}}
                @if($categoryId == '0')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                @else
                ajax: "{{ route( $PrefixRoute.".DataTableCategory",$categoryId) }}",
                @endif

                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                        @include('datatable.index_action_but',['type'=> 'photo','view'=> IsConfig($config, 'postPhotoAdd')])
                        @include('datatable.index_action_but',['type'=> 'PublishedDate','view'=> IsConfig($config, 'postPublishedDate')])
                        @include('datatable.index_action_but',['type'=> 'UserName','view'=> true ])
                    {
                        data: 'name', name: '{{$config['DbCategoryTrans']}}.name', orderable: true, searchable: true
                    },
                    @include('datatable.index_action_but',['type'=> 'CategoryName','view'=> IsConfig($config, 'TableCategory')])
                    @include('datatable.index_action_but',['type'=> 'isActive'])
                    @include('datatable.index_action_but',['type'=> 'morePhoto'])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                ],
            });
        });
    </script>

@endpush

