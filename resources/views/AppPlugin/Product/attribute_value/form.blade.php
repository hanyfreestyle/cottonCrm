@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-5">
                <h1 class="def_h1_new">{!! print_h1($Attribute) !!}</h1>
            </div>
            <div class="col-7 dir_button">
                <x-admin.form.action-button :url="route($PrefixRouteSub.'.index')" :l="__('admin/proProduct.att_but_attribute')" :tip="false" icon="fas fa-code-branch"/>
                <x-admin.form.action-button :url="route($PrefixRoute.'.index',$Attribute->id)" :l="__('admin/proProduct.att_but_value')" :tip="false" icon="fas fa-list-ol" bg="dark"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
            <input type="hidden" name="attribute_id" value="{{$Attribute->id}}">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <x-admin.form.print-error-div/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            @foreach ( config('app.web_lang') as $key=>$lang )
                                <div class="row">
                                    <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" :label="__('admin/form.text_name')" col="6" :tdir="$key"/>
                                    <x-admin.form.slug :viewtype="$pageData['ViewType']" :key="$key" col="6" :row="$rowData"/>
                                </div>
                            @endforeach
                        </x-admin.card.normal>

                    </div>
                    <div class="row mb-5">
                        <div class="col-lg-12">
                            <x-admin.form.submit-role-back :page-data="$pageData"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            <div class="row">
                                <x-admin.form.select-arr name="is_active" :sendvalue="old('is_active',IsArr($rowData,'is_active',1))" :label="__('admin/def.status')" col="12" type="selActive"/>
                            </div>
                        </x-admin.card.normal>
                    </div>
                </div>
            </div>
        </form>
    </x-admin.hmtl.section>

@endsection


@push('JsCode')
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
@endpush
