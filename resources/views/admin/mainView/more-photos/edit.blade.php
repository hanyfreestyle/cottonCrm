@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-lg-7">
                <h1 class="def_h1">{{ print_h1($rowData->modelName)}}</h1>
            </div>
            <div class="col-lg-5 dir_button">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.more_photos_list', $rowData->modelName->id )}}" type="sort" :tip="false"/>
                <x-admin.form.action-button url="{{route($PrefixRoute.'.morePhotos_editAll', $rowData->modelName->id )}}" :print-lable="__('admin/form.more_photo_edit')" :tip="false"/>
                <x-admin.form.action-button url="{{route($PrefixRoute.'.edit', $rowData->modelName->id)}}" type="back"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <form action="{{route($PrefixRoute.'.morePhotos_update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf

        <x-admin.hmtl.section>
            <div class="row">
                <div class="col-lg-9">
                    <x-admin.card.normal>
                        <x-admin.hmtl.confirm-massage/>

                        <div class="row">
                            @foreach ( config('app.web_lang') as $key=>$lang )
                                <x-admin.form.trans-text-area name="des" :key="$key" :row="$rowData"
                                                              :label="__('admin/form.text_content')" :tdir="$key" add-class="bigTextArea" col="12"/>
                            @endforeach
                        </div>

                    </x-admin.card.normal>
                </div>

                <div class="col-lg-3">
                    <x-admin.card.normal>
                        <div class="row">
                            <input type="hidden" name="model_id" value="{{intval($rowData->modelName->id)}}">
                            <input type="hidden" name="name" value="{{ print_h1($rowData->modelName)}}">
                            <x-admin.form.upload-file view-type="Edit" :row-data="$rowData"
                                                      thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_morephoto_filterid',0) }}"/>
                        </div>
                    </x-admin.card.normal>
                </div>
            </div>
        </x-admin.hmtl.section>


        <x-admin.hmtl.section>
            <div class="container-fluid mb-5">
                <x-admin.form.submit text="Edit"/>
            </div>
        </x-admin.hmtl.section>

    </form>

@endsection

@push('JsCode')
    <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
    @foreach ( config('app.web_lang') as $key=>$lang )
        <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key" :soft="true"/>
    @endforeach
@endpush
