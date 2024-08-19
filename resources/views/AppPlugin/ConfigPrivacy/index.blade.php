@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>

        <div class="row mb-3">
            <div class="col-12 text-left">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.Sort')}}" type="sort" :tip="false"/>
            </div>
        </div>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th>H1</th>
                    <th>H2</th>
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
                    {data: 'name2', name: 'name2', orderable: true, searchable: true},
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=> true])
                ],
            });
        });
    </script>
@endpush
