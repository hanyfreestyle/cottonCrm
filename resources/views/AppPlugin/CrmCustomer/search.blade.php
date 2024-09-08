@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.normal :page-data="$pageData" :title="$pageData['BoxH1']">
            <div class="row">
                <div class="col-md-12">
                    <form class="mainForm" action="{{route($PrefixRoute.'.searchFilter')}}" method="post">
                        @csrf
                        <input type="hidden" id="postset" value="{{issetArr($_POST,'search_type',null)}}">
                        <div class="row CustomersSearchForm">
                            <x-admin.form.select-arr name="search_type" :sendvalue="old('search_type',issetArr($_POST,'search_type',1))" :send-arr="$CustomersSearchType"
                                                     :labelview="false" :label="__('admin/crm_customer.search_type')" col="3" :col-mobile="12"/>

                            <x-admin.form.input name="name" type="number" :labelview="false" :value="old('name', issetArr($_POST,'name'))" :placeholder="true" col="7" tdir="ar"
                                                :label="__('admin/crm_customer.search_text')"/>
                            <div class="form-group col-lg-2">
                                <button type="submit" name="B1" class="btn btn-primary but_icon w-100 float-left">
                                    <i class="fas fa-search"></i> {{__('admin/form.button_search')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-admin.card.normal>


        @if(count($lastAdd))
            <x-admin.card.normal :page-data="$pageData" :outline="false">
                @include('AppPlugin.CrmCustomer.inc_table',['rowData'=>$lastAdd])
            </x-admin.card.normal>
        @else
            @if(count($rowData)>0)
                <x-admin.card.normal :page-data="$pageData" :outline="false" :title="$pageData['BoxH2']">
                    @include('AppPlugin.CrmCustomer.inc_table')
                </x-admin.card.normal>
            @else
                @if($nodata)
                    <div class="col-lg-12">
                        <x-admin.hmtl.alert-massage type="nodata"/>
                    </div>
                    @if($request->search_type == 1)
                        <div class="col-lg-3 float-left">
                            <div class="form-group col-lg-12">
                                <a href="{{route('admin.CrmCustomer.addNew',['s'=>$request->search_type,'n'=>$request->name])}}" class="btn btn-primary w-100 but_icon ">
                                    <i class="fas fa-user-plus"></i> {{__('admin/crm_customer.but_add_new')}}</a>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        @endif
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <script>
        $(document).ready(function () {
            var postset = $('#postset').val();
            if (postset != '') {
                if (postset == 1) {
                    $('#name').attr('type', 'number');
                } else {
                    $('#name').attr('type', 'text');
                }
            }
        });

        $('#search_type').change(function () {
            var typeis = $(this).val();
            // alert(typeis);
            if (typeis == 1) {
                $('#name').attr('type', 'number');
            } else {
                $('#name').attr('type', 'text');
            }
            $("#name").val('');
        });


    </script>
@endpush

