@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>

        @if(Route::currentRouteName() == $PrefixRoute . '.All' or Route::currentRouteName() == $PrefixRoute . '.filter'  )
            <div class="row">
                <div class="col-lg-12">
                    <x-app-plugin.crm-service.leads.form-filter form-name="{{$formName}}" :row="$rowData" :user="true" :state-open="true" :config="$config"/>
                </div>
            </div>
        @endif

        <div class="row">
            <x-admin.card.normal :page-data="$pageData" :title="$pageData['BoxH1']">
                <table {!! Table_Style_Yajra() !!} >
                    <thead>
                    <tr>

                        <th class="all">#</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm.label_date_add')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm.label_date_follow')}}</th>
                        <th class="desktop">{{__('admin/crm_service.label_user_id')}}</th>
                        <th class="desktop">{{__('admin/crm.label_customer_name')}}</th>
                        <th class="all">{{__('admin/crm.label_customer_mobile')}}</th>
                        <th class="desktop">{{__('admin/crm.label_customer_area')}}</th>
                        <th class="desktop">{{__('admin/crm.label_state')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm_service.label_device')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm_service.label_notes_err')}}</th>
                        <th class="{{returnTableRes($agent)}}">{{__('admin/crm.label_notes')}}</th>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" res="all" type="edit"/>
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
                    {'name': 'created_at', 'data': {'_': 'created_at.display', 'sort': 'created_at.timestamp'}},
                    {'name': 'follow_date', 'data': {'_': 'follow_date.display', 'sort': 'created_at.timestamp'}},
                    {data: 'user_name', name: 'user.name', orderable: true, searchable: true},
                    {data: 'name', name: 'customer.name', orderable: true, searchable: true},
                    {data: 'mobile', name: 'customer.mobile', orderable: true, searchable: true},
                    {data: 'area', name: 'area', orderable: false, searchable: false},
                    {data: 'follow_state', name: 'follow_state', orderable: false, searchable: false},
                    {data: 'device', name: 'device_name.name', orderable: true, searchable: true},
                    {data: 'notes_err', name: 'notes_err', orderable: false, searchable: false},
                    {data: 'notes', name: 'notes', orderable: false, searchable: false},

                    @include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>'viewTicket'])
                    @include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>'changeUser'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                    @include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_edit','data'=>'viewInfo'])
                ],

            });
        });
    </script>
@endpush
