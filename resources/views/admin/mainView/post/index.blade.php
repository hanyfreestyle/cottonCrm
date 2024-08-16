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

{{--                    @if($Config['postPhotoView'])--}}
{{--                        <th class="TD_20"></th>--}}
{{--                    @endif--}}

{{--                    @if($Config['postPublishedDate'])--}}
{{--                        <th class="TD_100">{{$Config['LangPostPublishedDateName']}}</th>--}}
{{--                    @endif--}}

{{--                    <th class="TD_250">{{$Config['LangPostDefName']}}</th>--}}

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

{{--                        @if($Config['postPublishedDate'])--}}
{{--                            <td class="tc">{{$row->getFormatteDate()}}</td>--}}
{{--                        @endif--}}


{{--                        <td>{{$row->name ?? ''}}</td>--}}

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

{{--                            <td>{!! is_active($row->is_active) !!}</td>--}}
{{--                            <x-admin.table.action-but type="edit" :row="$row"/>--}}
{{--                            <x-admin.table.action-but type="delete" :row="$row"/>--}}
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
@endpush

