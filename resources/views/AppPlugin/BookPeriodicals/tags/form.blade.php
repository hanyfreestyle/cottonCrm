@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
                @csrf
                <div class="row">
                    <x-admin.form.input name="name" :row="$rowData" :label="__('admin/form.text_name')" col="12" tdir="ar"/>
                </div>
                <hr>
                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection


@push('JsCode')

@endpush
