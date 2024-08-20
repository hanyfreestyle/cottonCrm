@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        @if(($rowData->count())>0)
            <div class="col-lg-12">
                <x-app-plugin.crm.customers.form-filter form-name="{{$formName}}" :row="$rowData" :config="$config"/>
            </div>
        @endif
        <div class="col-lg-12">
            <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
                <table {!! Table_Style_Yajra() !!} >
                    <thead>
                    <tr>
                        <th class="all">#</th>
                        <x-admin.table.action-but res="d" po="top" type="empty" :view-but="IsConfig($config,'list_flag')"/>
                        <th class="all">{{__($defLang.'form_name')}}</th>
                        <th class="all">{{__($defLang.'form_mobile')}}</th>
                        <th class="desktop">{{__($defLang.'form_whatsapp')}}</th>
                        <x-admin.table.action-but po="top" res="desktop" type="option" :l="__($defLang.'form_evaluation')" :view-but="IsConfig($config,'list_evaluation')"/>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="edit"/>
                        <x-admin.table.action-but po="top" type="delete" :view-but="true"/>
                        <x-admin.table.action-but po="top" type="can" can="crm_leads_add"/>
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
                        @include('datatable.index_action_but',['type'=> 'Flag','view'=> IsConfig($config, 'list_flag')])
                    {
                        data: 'name', name: 'name', orderable: true, searchable: true
                    },
                    {data: 'mobile', name: 'mobile', orderable: true, searchable: true, className: ""},
                    {data: 'whatsapp', name: 'whatsapp', orderable: true, searchable: true, className: ""},
                    @include('datatable.index_action_but',['type'=> 'option',"data"=>"evaluation",'option'=> IsConfig($config, 'list_evaluation')])
                    @include('datatable.index_action_but',['type'=> 'Profile'])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                    @include('datatable.index_action_but',['type'=> 'can','can'=> 'crm_leads_add',"data"=>"addTicket"])
                ],

            });
        });
    </script>
@endpush

