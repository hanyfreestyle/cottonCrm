@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')

    @include('AppPlugin.Product.index_breadcrumb')

    @if($filterRoute)
        <x-admin.hmtl.section>
            <x-admin.product.filter :row="$rowData" form-name="{{$formName}}" :def-route="$filterRoute"/>
        </x-admin.hmtl.section>
    @endif

    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12 mb-5">
                <table {!! Table_Style_Yajra() !!} >
                    <thead>
                    <tr>
                        <th class="TD_20">#</th>
                        <x-admin.table.action-but po="top" type="photo" res="all" :view-but="true"/>
                        <th>{{ __('admin/proProduct.pro_text_name') }}</th>
                        <x-admin.data-table.row-th-table set-name="category_view" db-table="TableCategory" :l="__('admin/proProduct.cat_text_name')"/>
                        <x-admin.data-table.row-th-table set-name="brand_view" db-table="TableBrand" :l="__('admin/proProduct.app_menu_brand')"/>
                        <x-admin.data-table.row-th-table set-name="price_view" :l="__('admin/proProduct.pro_text_regular_price')"/>
                        <x-admin.data-table.row-th-table set-name="price_view" :l="__('admin/proProduct.pro_text_price')"/>
                        @if($dataSend['PageView'] == "SoftDelete")
                            <x-admin.table.soft-delete/>
                        @else
                            <x-admin.table.action-but po="top" type="isActive"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete" :view-but="true"/>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
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
                ajax: "{{ route($PrefixRoute.'.DataTable',['dataSend' => $dataSend ,'formName'=>$formName]) }}",
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false, className: "remove_id"},
                        @include('datatable.index_action_but',['type'=> 'photo','view'=> true])
                    {
                        data: 'name', name: '{{$config['DbPostTrans']}}.name', orderable: true, searchable: true
                    },
                    @include('datatable.index_option_but',['d'=> 'CategoryName','dn'=>$config['DbCategoryTrans'].'name','arr'=>['db'=>'TableCategory','config'=>'category_view']])
                    @include('datatable.index_option_but',['d'=> 'brand_name','dn'=>$config['DbBrandTrans'].'name','arr'=>['db'=>'TableBrand','config'=>'brand_view']])
                    @include('datatable.index_option_but',['d'=> 'regular_price','dn'=>'regular_price','arr'=>['c'=>'text-center','config'=>'price_view']])
                    @include('datatable.index_option_but',['d'=> 'price','dn'=>'price','arr'=>['c'=>'text-center','config'=>'price_view']])
                    @if($dataSend['PageView'] == "SoftDelete")
                    @include('datatable.index_action_but',['type'=> 'deleted_at','view'=>true  ])
                    @include('datatable.index_action_but',['type'=> 'Restore','view'=>true  ])
                    @include('datatable.index_action_but',['type'=> 'ForceDelete','view'=>true  ])
                    @else
                    @include('datatable.index_action_but',['type'=> 'isActive'])
                    @include('datatable.index_action_but',['type'=> 'edit'])
                    @include('datatable.index_action_but',['type'=> 'delete','view'=>true  ])
                    @endif
                ],
            });
        });
    </script>
@endpush

