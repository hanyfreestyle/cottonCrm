@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">
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
