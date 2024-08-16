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
                    <th class="TD_200">{{__('admin/form.text_name')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete" :view-but="true"/>
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
                pageLength: {{$yajraPerPage}},
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",

                columns: [
                    {data: 'id', name: 'id', orderable: true, searchable: true},
                    {data: 'name', name: '{{ $config['DbTagsTrans'].".name"}}', orderable: true},
                        @include('datatable.index_action_but',['type'=> 'edit'])
                        @include('datatable.index_action_but',['type'=> 'delete','view'=> true])

                ],

            });
        });
    </script>
@endpush

