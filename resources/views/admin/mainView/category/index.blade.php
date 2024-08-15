@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    @include('admin.mainView.category.inc_but_sort')

    <x-admin.hmtl.section>
        @include('admin.mainView.category.inc_but_breadcrumb')

        <x-admin.card.def :page-data="$pageData">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            @if(IsConfig($Config, 'categoryPhotoView'))
                                <th class="TD_20"></th>
                            @endif
                            <th>{{DefCategoryTextName(IsConfig($Config, 'LangCategoryDefName',null))}}</th>
                            <th class="TD_20"></th>
                            <x-admin.table.action-but po="top" type="addLang"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                            @if(IsConfig($Config, 'categoryDelete'))
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                @if(IsConfig($Config, 'categoryPhotoView'))
                                    <td class="tc">{!! TablePhoto($row,'photo') !!} </td>
                                @endif
                                <td>{!! printCategoryName(IsArr($Config,'categoryDefLang',null),$row,$PrefixRoute.".SubCategory") !!}</td>
                                <td>{!! is_active($row->is_active) !!}</td>
                                <x-admin.table.action-but type="addLang" :row="$row"/>
                                <x-admin.table.action-but type="edit" :row="$row"/>
                                @if(IsConfig($Config, 'categoryDelete'))
                                    <x-admin.table.action-but type="delete" :row="$row"/>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData"/>

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush

