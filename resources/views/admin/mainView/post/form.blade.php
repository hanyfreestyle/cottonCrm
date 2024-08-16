@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

{{--    <x-admin.hmtl.top-edit-page :page-data="$pageData" :row="$rowData" web-slug="BlogView"/>--}}
    <x-admin.hmtl.section>
        <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">
            <input type="hidden" name="config" value="{{json_encode($config)}}">
            <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
            @csrf
            <x-admin.form.print-error-div/>

            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-12">
                            <div class="row">
                                @if(IsConfig($config, 'TableCategory'))
                                    <x-admin.form.select-multiple name="categories" :categories="$Categories" :sel-cat="$selCat" col="12"/>
                                @endif
                                @if(IsConfig($config, 'TableTags'))
                                    <x-admin.form.select-multiple name="tag_id" :categories="$tags" :sel-cat="$selTags" col="12" :label="__('admin/def.form_tags')"/>
                                @endif
                            </div>

                            @foreach ( $LangAdd as $key=>$lang )
                                <div class="row">
                                    <x-admin.lang.meta-tage-seo :lang-add="$LangAdd" :viewtype="$pageData['ViewType']" :row="$rowData" :key="$key"
                                                                :slug="IsConfig($config, 'postSlug')" :des="IsConfig($config, 'postDes')"
                                                                :def-name="IsConfig($config, 'LangPostDefName')" :def-des="IsConfig($config, 'LangPostDefDes')"/>
                                </div>
                            @endforeach

                            @if(IsConfig($config, 'postYoutube'))
                                <div class="row">
                                    <x-admin.form.input name="youtube" :row="$rowData" :label="__('admin/form.text_youtube')" col="4" tdir="en" :req="false"/>
                                    @foreach ( $LangAdd as $key=>$lang )
                                        <x-admin.form.trans-input name="youtube_title" :key="$key" :row="$rowData" :label="__('admin/form.text_youtube_title')" col="4" :req="false"
                                                                  :tdir="$key"/>
                                    @endforeach
                                </div>
                            @endif

                        </x-admin.card.normal>
                    </div>
                </div>

                <div class="col-lg-3">
                    @include('admin.mainView.post.inc_left_side')
                    @if(IsConfig($config, 'postSeo'))
                        @include('admin.mainView.post.inc_seo_side')
                    @endif
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-lg-12 float-left text-left">
                    <x-admin.form.submit-role-back :page-data="$pageData"/>
                </div>
            </div>
        </form>

    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    {{--    @if($Config['TableTags'] and $Config['TableTagsOnFly'] )--}}
    {{--        <x-admin.ajax.tag-serach/>--}}
    {{--    @endif--}}
    @if(IsConfig($config, 'postEditor'))
        <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
        @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
        @endforeach
    @endif
@endpush
