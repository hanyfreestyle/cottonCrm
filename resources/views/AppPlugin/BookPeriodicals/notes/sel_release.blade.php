@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-app-plugin.crm.book.form-release-filter form-name="{{$formName}}" :row="$rowData"/>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        @if(count($rowData)>0)
            <x-admin.card.normal>
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style(false,false)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_100">{{__('admin/Periodicals.notes_release')}}</th>
                            <th class="TD_100">{{__('admin/Periodicals.form_release_year')}}</th>
                            <th class="TD_100">{{__('admin/Periodicals.form_release_month')}}</th>
                            <th class="TD_100">{{__('admin/Periodicals.form_release_num')}}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->periodicals->name}}</td>
                                <td>{{$row->year}}</td>
                                <td>{{$row->month}}</td>
                                <td>{{$row->number}}</td>
                                <td class="td_action">
                                    <x-admin.form.action-button url="{{route('admin.Periodicals.Notes.create',$row->id)}}"
                                                                :print-lable="__('admin/Periodicals.but_filter_sel')" :tip="false" icon="fas fa-plus"/>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </x-admin.card.normal>
        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif
    </x-admin.hmtl.section>


@endsection



@push('JsCode')

@endpush
