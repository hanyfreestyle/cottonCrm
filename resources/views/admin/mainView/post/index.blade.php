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
                    <x-admin.table.action-but po="top" type="PublishedDate" res="all" :view-but="IsConfig($config, 'postPublishedDate')"/>
                    <x-admin.table.action-but po="top" type="photo" res="all" :view-but="IsConfig($config, 'postPhotoAdd')"/>
                    <th>{{DefCategoryTextName(IsConfig($config, 'LangPostDefName',null))}}</th>

                    <x-admin.table.action-but po="top" type="isActive"/>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete" :view-but="IsConfig($config, 'postDelete')"/>



                    {{--                    @if($pageData['ViewType'] == 'deleteList')--}}
                    {{--                        <x-admin.table.soft-delete/>--}}
                    {{--                    @else--}}

                    {{--                        @if($Config['TableCategory'])--}}
                    {{--                            <th class="TD_250">{{__('admin/blogPost.cat_text_name')}}</th>--}}
                    {{--                        @endif--}}

                    {{--                        <th class="TD_20"></th>--}}
                    {{--                        <x-admin.table.action-but po="top" type="edit"/>--}}
                    {{--                        <x-admin.table.action-but po="top" type="delete"/>--}}
                    {{--                    @endif--}}
                </tr>
                </thead>
                <tbody>
                {{--                @foreach($rowData as $row)--}}
                {{--                    <tr>--}}
                {{--                        <td>{{$row->id}}</td>--}}
                {{--                        @if($Config['postPhotoView'])--}}
                {{--                            <td class="tc">{!! TablePhoto($row,'photo') !!} </td>--}}
                {{--                        @endif--}}



                {{--                        @if($pageData['ViewType'] == 'deleteList')--}}
                {{--                            <x-admin.table.soft-delete type="b" :row="$row"/>--}}
                {{--                        @else--}}

                {{--                            @if($Config['TableCategory'])--}}
                {{--                                <td>--}}
                {{--                                    @foreach($row->categories as $Category )--}}
                {{--                                        <a href="{{route($PrefixRoute.'.ListCategory',$Category->id)}}">--}}
                {{--                                            <span class="cat_table_name">{{ print_h1($Category)}}</span>--}}
                {{--                                        </a>--}}
                {{--                                    @endforeach--}}
                {{--                                </td>--}}
                {{--                            @endif--}}


                {{--                        @endif--}}
                {{--                    </tr>--}}
                {{--                @endforeach--}}
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
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                    {
                        'name': 'published_at',
                        'data': {
                            '_': 'published_at.display',
                            'sort': 'published_at.timestamp'
                        }
                    },
                        @include('datatable.index_action_but',['type'=> 'photo','view'=> IsConfig($config, 'postPhotoAdd')])
                    {
                        data: 'name', name: '{{$config['DbCategoryTrans']}}.name', orderable: true, searchable: true
                    },

                    @include('datatable.index_action_but',['type'=> 'isActive'])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> IsConfig($config, 'postDelete')])
                ],
            });
        });
    </script>

@endpush

