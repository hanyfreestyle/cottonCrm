@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        {{--    <x-admin.main.filter-form form-name="{{$formName}}" :row="$rowData"/>--}}

        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th>{{__('admin/leadsNewsLetter.t_email')}}</th>
                    <th>{{__('admin/leadsNewsLetter.t_date_add')}}</th>

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
                pageLength: {{$yajraPerPage ?? 10 }},
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.'.DataTable') }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                    {data: 'email', name: 'email', orderable: true, searchable: true},
                    {'name': 'created_at', 'data': {'_': 'created_at.display', 'sort': 'created_at.timestamp'}},
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                ],
            });
        });
    </script>
@endpush
