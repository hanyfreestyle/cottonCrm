@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">

            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th>{{__('admin/config/upFilter.form_name')}}</th>
                    <th>{{__('admin/config/upFilter.form_type')}}</th>
                    <th class="tdc desktop">{{__('admin/config/upFilter.form_new_w')}}</th>
                    <th class="tdc desktop">{{__('admin/config/upFilter.form_new_h')}}</th>
                    <th class="tdc desktop">WEBP</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>

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
    <x-admin.data-table.plugins-yajra :jscode="true"/>
    <script type="text/javascript">
        $(function () {
            $('#YajraDatatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: {{$yajraPerPage ?? 25 }},
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.'.DataTable') }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'type', name: 'type', orderable: true, searchable: true},
                    {data: 'new_w', name: 'new_w', orderable: true, searchable: true},
                    {data: 'new_h', name: 'new_h', orderable: true, searchable: true},
                    {data: 'convert_state', name: 'convert_state', orderable: false, searchable: false, className: "text-center"},
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                ],
            });
        });
    </script>

@endpush
