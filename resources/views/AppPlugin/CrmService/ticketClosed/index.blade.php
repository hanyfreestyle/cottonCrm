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

        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="all">#</th>
                    <th class="{{returnTableRes($agent)}}">{{__('admin/crm.label_date_add')}}</th>
                    <th class="desktop">{{__('admin/crm.label_date_closed')}}</th>
                    <th class="desktop">{{__('admin/crm_service.label_user_id')}}</th>
                    <th class="desktop">{{__('admin/crm.label_customer_name')}}</th>
                    <th class="all">{{__('admin/crm.label_customer_mobile')}}</th>
                    <th class="desktop">{{__('admin/crm.label_customer_area')}}</th>

                    <th class="{{returnTableRes($agent)}}">{{__('admin/crm_service.label_device')}}</th>
                    <th class="{{returnTableRes($agent)}}">{{__('admin/crm_service.label_notes_err')}}</th>
                    <th class="{{returnTableRes($agent)}}">{{__('admin/crm.label_notes')}}</th>
                    @if($AddCost)
                        <th>{{__('admin/crm_customer.profile_card_6')}}</th>
                    @endif
                    <x-admin.table.action-but po="top" type="delete"/>
                    <x-admin.table.action-but po="top" res="all" type="empty"/>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection

@push('JsCode')
    <x-admin.data-table.sweet-dalete/>
    <x-app-plugin.crm-service.ajax.ticket-info />
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [0, 'desc'],
                pageLength: {{$yajraPerPage}},
                @include('datatable.lang')

                ajax: "{{ route( $PrefixRoute.".DataTable",$RouteVal) }}",
                columns: [
                    {data: 'id', name: 'id', orderable: true, searchable: true},
                    {'name': 'created_at', 'data': {'_': 'created_at.display', 'sort': 'created_at.timestamp'}},
                    {'name': 'close_date', 'data': {'_': 'close_date.display', 'sort': 'close_date.timestamp'}},
                    {data: 'user_name', name: 'users.name', orderable: true, searchable: true},
                    {data: 'customers_name', name: 'crm_customers.name', orderable: true, searchable: true},
                    {data: 'customers_mobile', name: 'crm_customers.mobile', orderable: true, searchable: true},
                    {data: 'area_name', name: 'area_name', orderable: false, searchable: false},

                    {data: 'device_name', name: 'device_name', orderable: false, searchable: false},
                    {data: 'notes_err', name: 'notes_err', orderable: false, searchable: false},
                    {data: 'notes', name: 'notes', orderable: false, searchable: false},
                    @include('datatable.index_action_but',['type'=> 'option','option'=> $AddCost ,'data'=>"cost"])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                    @include('datatable.index_action_but',['type'=> 'can','can'=> $PrefixRole.'_view','data'=>'viewInfo'])
                ],

            });
        });
    </script>
@endpush

