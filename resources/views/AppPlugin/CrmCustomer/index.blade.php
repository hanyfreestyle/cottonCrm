@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        @if(($rowData->count())>0)
            <div class="col-lg-12">
                <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :config="$Config"/>
            </div>
        @endif
        <div class="col-lg-12">
            <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
                <table {!! Table_Style_Yajra() !!} >
                    <thead>
                    <tr>
                        <th class="all">#</th>
                        @if($Config['list_flag'])
                            <th class="TD_20 desktop"></th>
                        @endif
                        <th class="all">{{__($defLang.'form_name')}}</th>
                        @if($Config['list_evaluation'])
                            <th class="desktop">{{__($defLang.'form_evaluation')}}</th>
                        @endif
                        <th class="all">{{__($defLang.'form_mobile')}}</th>
                        <th class="desktop">{{__($defLang.'form_whatsapp')}}</th>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="delete"/>
                        @can('crm_leads_add')
                            <x-admin.table.action-but po="top" type="add"/>
                        @endcan

                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </x-admin.card.def>
        </div>
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

                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
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
                        data: 'mobile', name: 'mobile', orderable: true, searchable: true, className: "dir_leftX"
                    },
                    {data: 'whatsapp', name: 'whatsapp', orderable: true, searchable: true, className: "dir_leftX"},


                        @can($PrefixRole.'_edit')
                    {
                        data: 'Profile', name: 'Profile', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                        @endcan

                        @can($PrefixRole.'_delete')

                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center actionButView"
                    },

                    @endcan

                    @can('crm_leads_add')
                    {
                        data: 'addTicket', name: 'addTicket', orderable: false, searchable: false, className: "text-center actionButView"
                    },

                    @endcan


                ],

            });
        });
    </script>
@endpush

