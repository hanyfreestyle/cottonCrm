@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    @can($PrefixRole."_edit")
        <x-admin.hmtl.section>
            <div class="row mb-3">
                <div class="col-12 dir_button">
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.Sort')}}" type="sort" :tip="false"/>
                </div>
            </div>
        </x-admin.hmtl.section>
    @endcan

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style_Yajra() !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
                    <th class="TD_100">{{ __('admin/proProduct.att_attribute_name') }}</th>
                    <th class="desktop">{{ __('admin/proProduct.att_attribute_value_name') }}</th>
                    <x-admin.table.action-but po="top" type="empty"/>
                    <x-admin.table.action-but po="top" type="add"/>
                    <x-admin.table.action-but po="top" res="all" type="isActive"/>
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
                @include('datatable.lang')
                ajax: "{{ route( $PrefixRoute.".DataTable") }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                    {
                        data: 'name', name: 'pro_attribute_lang.name', orderable: true, searchable: true
                    },
                    {
                        data: 'values_names', name: 'pro_attribute_lang.name', orderable: false, searchable: false
                    },
                    @include('datatable.index_action_but',['type'=> 'can','can'=>'Product_view','data'=>"AttValueList"])
                    @include('datatable.index_action_but',['type'=> 'can','can'=>'Product_add','data'=>"AttValueAdd"])
                    @include('datatable.index_action_but',['type'=> 'isActive'])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=>true  ])
                ],
            });
        });
    </script>
@endpush

