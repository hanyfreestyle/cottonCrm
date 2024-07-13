@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.form.filter-blank form-name="{{$formName}}" :row="$rowData">
            <x-admin.form.select-multiple :has-trans="false" name="tag_id" :categories="$tags" col="12" :req="false"
                                          :sel-cat="old('tag_id',issetArr($getSession,'tag_id'))" :label="__('admin/Periodicals.app_menu_tags')"/>
        </x-admin.form.filter-blank>


        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <table {!!Table_Style(true,true) !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_80">{{__('admin/Periodicals.notes_date')}}</th>
                    <th class="TD_100">{{__('admin/Periodicals.notes_name')}}</th>
                    <th class="TD_200">{{__('admin/Periodicals.notes_release')}}</th>
                    <th class="TD_150">{{__('admin/Periodicals.form_des')}}</th>
                    <th class="TD_200">{{__('admin/Periodicals.app_menu_tags')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>
                </tr>
                </thead>
                <tbody></tbody>
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
                pageLength: 25,
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {
                        'name': 'created_at',
                        'data': {
                            '_': 'created_at.display',
                            'sort': 'created_at.timestamp'
                        }
                    },
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'releaseName', name: 'releaseName', orderable: false, searchable: false},
                    {data: 'des', name: 'des', orderable: true, searchable: true},
                    {data: 'TagsName', name: 'TagsName', orderable: false, searchable: false},
                        @can($PrefixRole.'_edit')
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center"

                    },
                        @endcan

                        @can($PrefixRole.'_delete')
                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center"
                    },

                    @endcan
                ],

            });
        });
    </script>
@endpush

