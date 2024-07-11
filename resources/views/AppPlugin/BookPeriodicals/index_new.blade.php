@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-6">
            </div>
            <div class="col-6 dir_button">
                <x-admin.form.action-button url="{{route('admin.Periodicals.AddRelease',$periodicalsId)}}" type="AddRelease" :tip="false"/>
            </div>
        </div>
    </x-admin.hmtl.section>


    <x-admin.hmtl.section>
{{--        <x-app-plugin.crm.book.form-filter form-name="{{$formName}}" :row="$rowData"/>--}}
        <x-admin.card.normal :title="$pageData['BoxH1']">
            <table {!!Table_Style(true,true) !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_100">{{__('admin/Periodicals.form_release_year')}}</th>
                    <th class="TD_100">{{__('admin/Periodicals.form_release_month')}}</th>
                    <th class="TD_100">{{__('admin/Periodicals.form_release_num')}}</th>
                    <th class="TD_250">{{__('admin/Periodicals.form_release_notes')}}</th>
                    <th class="TD_100">{{__('admin/Periodicals.form_release_repeat')}}</th>
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </x-admin.card.normal>


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
                pageLength: 25,
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".ReleaseDataTable",$periodicalsId) }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},

                    {data: 'year', name: 'year', orderable: true, searchable: true, className: "text-center" },
                    {data: 'month', name: 'month', orderable: false, searchable: false, className: "text-center" },
                    {data: 'number', name: 'number', orderable: true, searchable: true, className: "text-center" },
                    {data: 'notes', name: 'notes', orderable: true, searchable: true, },
                    {data: 'repeat', name: 'repeat', orderable: false, searchable: false, className: "text-center" },
                        @can($PrefixRole.'_edit')
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

