@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" :label=" __('admin/form.text_name')" :tdir="$key" col="6"/>
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <x-admin.form.check-active :row="$rowData" name="is_active" :lable="__('admin/def.status_active')" page-view="{{$pageData['ViewType']}}"/>
                </div>
                <hr>
                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
@endpush
