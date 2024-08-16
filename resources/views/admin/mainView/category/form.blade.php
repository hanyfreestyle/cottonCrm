@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @include('admin.mainView.category.inc_but_edit_form')
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="config" value="{{json_encode($config)}}">
            <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
            @csrf
            <div class="row">
                <x-admin.form.print-error-div/>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            @foreach ( $LangAdd as $key=>$lang )
                                <div class="row">
                                    <x-admin.lang.meta-tage-seo :lang-add="$LangAdd" :viewtype="$pageData['ViewType']" :row="$rowData" :key="$key"
                                                                :slug="IsConfig($config, 'categorySlug')" :des="IsConfig($config, 'categoryDes')"
                                                                :def-name="IsConfig($config, 'LangCategoryDefName')" :def-des="IsConfig($config, 'LangCategoryDefDes')"/>
                                </div>
                            @endforeach
                        </x-admin.card.normal>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="row">
                        @include('admin.mainView.category.inc_left_side')
                    </div>
                    @if(IsConfig($config, 'categorySeo'))
                        @include('admin.mainView.category.inc_seo_side')
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 float-left text-left">
                    <x-admin.form.submit-role-back :page-data="$pageData"/>
                </div>
            </div>
        </form>
    </x-admin.hmtl.section>

@endsection


@push('JsCode')
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    <x-admin.table.sweet-delete-js/>
    @if(IsConfig($config, 'categoryEditor'))
        <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
        @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
        @endforeach
    @endif
@endpush
