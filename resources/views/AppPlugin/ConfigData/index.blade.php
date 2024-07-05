@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-12 dir_button">
                @if(Route::currentRouteName() == $PrefixRoute.'.archived')
                    <a class="btn btn-primary" href="{{route($PrefixRoute.".index")}}">{{__('admin/def.page_list')}}</a>
                @else
                    <a class="btn btn-danger" href="{{route($PrefixRoute.".archived")}}">{{__('admin/def.status_unactive_but')}}</a>
                @endif
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style(true,true)  !!} >
                <thead>
                <tr>
                    <th class="tdc"></th>
                    <th>{{__('admin/form.text_name')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    @if($AppPluginConfig['deleteData'])
                        <x-admin.table.action-but po="top" type="delete"/>
                    @endif
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
    <x-admin.data-table.plugins :jscode="true" :is-active="true"/>
    <script type="text/javascript">
        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.$route) }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'config_data_translations.name', orderable: true},
                        @can($PrefixRole.'_edit')
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false
                    },
                        @endcan

                        @can($PrefixRole.'_delete')
                        @if($AppPluginConfig['deleteData'])
                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false
                    },
                    @endif

                    @endcan
                ],

            });
        });
    </script>
@endpush

