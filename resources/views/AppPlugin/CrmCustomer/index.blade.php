@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :config="$Config"/>
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <table {!!Table_Style(true,true) !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    @if($Config['list_flag'])
                        <th class="TD_20"></th>
                    @endif
                    <th class="TD_200">{{__($defLang.'form_name')}}</th>
                    @if($Config['list_evaluation'])
                        <th class="TD_100">{{__($defLang.'form_evaluation')}}</th>
                    @endif
                    <th class="TD_100">{{__($defLang.'form_mobile')}}</th>
                    <th class="TD_100">{{__($defLang.'form_whatsapp')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData"/>

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
                @include('datatable.lang')

                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                        @if($Config['list_flag'])
                    {
                        data: 'Flag', name: 'Flag', orderable: false, searchable: false, className: "text-center"
                    },
                        @endif

                    {
                        data: 'name', name: 'name', orderable: true, searchable: true
                    },

                        @if($Config['list_evaluation'])
                    {
                        data: 'evaluation', name: 'evaluation', orderable: true, searchable: false
                    },
                        @endif

                    {
                        data: 'mobile', name: 'mobile', orderable: true, searchable: true, className: "dir_left"
                    },
                    {data: 'whatsapp', name: 'whatsapp', orderable: true, searchable: true, className: "dir_left"},
                        @can($PrefixRole.'_edit')
                    {
                        data: 'Profile', name: 'Profile', orderable: false, searchable: false, className: "text-center"
                    },
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

