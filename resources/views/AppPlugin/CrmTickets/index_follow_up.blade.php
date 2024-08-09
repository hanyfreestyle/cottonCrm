@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        {{--        <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :config="$Config"/>--}}
        <div class="row">
            <x-admin.card.normal :page-data="$pageData" :title="$pageData['BoxH1']">
                <table {!! Table_Style_Yajra() !!} >
                    <thead>
                    <tr>
                        <th class="all">#</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm/ticket.t_date_add')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm/ticket.t_date_follow')}}</th>
                        <th class="desktop">{{__('admin/crm/ticket.t_user_name')}}</th>
                        <th class="desktop">{{__('admin/crm/ticket.t_customer_name')}}</th>
                        <th class="all">{{__('admin/crm/ticket.t_customer_mobile')}}</th>
                        <th class="desktop">{{__('admin/crm/ticket.t_customer_area')}}</th>

                        <th class="desktop">{{__('admin/crm/ticket.t_ticket_state')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm/ticket.t_device')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm/ticket.fr_notes_err')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm/ticket.fr_notes')}}</th>

                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top"  res="all" type="edit"/>
                        <x-admin.table.action-but po="top" type="delete"/>
                        <x-admin.table.action-but po="top" res="all" type="edit"/>
                    </tr>
                    </thead>
                    <tbody></tbody>

                </table>
            </x-admin.card.normal>
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

                ajax: "{{ route( $PrefixRoute.".DataTable",$RouteVal) }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {
                        'name': 'created_at',
                        'data': {
                            '_': 'created_at.display',
                            'sort': 'created_at.timestamp'
                        }
                    },
                    {
                        'name': 'follow_date',
                        'data': {
                            '_': 'follow_date.display',
                            'sort': 'created_at.timestamp'
                        }
                    },

                    {data: 'user_name', name: 'user.name', orderable: true, searchable: true},
                    {data: 'name', name: 'customer.name', orderable: true, searchable: true},
                    {data: 'mobile', name: 'customer.mobile', orderable: true, searchable: true},
                    {data: 'area', name: 'area', orderable: false, searchable: false},
                    {data: 'device', name: 'device_name.name', orderable: true, searchable: true},
                    {data: 'follow_state', name: 'follow_state', orderable: false, searchable: false},
                    {data: 'notes_err', name: 'follow_state', orderable: false, searchable: false},
                    {data: 'notes', name: 'follow_state', orderable: false, searchable: false},

                        @can($PrefixRole.'_edit')
                    {
                        data: 'viewTicket', name: 'viewTicket', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                    {
                        data: 'changeUser', name: 'changeUser', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                        @endcan

                        @can($PrefixRole.'_delete')
                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                        @endcan

                        @can($PrefixRole.'_edit')
                    {
                        data: 'viewInfo', name: 'viewInfo', orderable: false, searchable: false, className: "text-center actionButView"
                    },
                    @endcan

                ],

            });
        });
    </script>
@endpush

