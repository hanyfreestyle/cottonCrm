<div class="row">
    <x-admin.card.normal col="col-lg-12">
        @if($pageData['ViewType'] == 'Edit')
            <div class="row LeftSideInfo">
                <div class="col-lg-12">
                    <div class="info">{{__('admin/def.lable_date_add')}} : <span> {{ PrintDate($rowData->created_at) }}</span></div>
                    <div class="info">{{__('admin/def.lable_date_update')}} : <span>{{ PrintDate($rowData->updated_at , "Y-m-d H:i:s") }}</span></div>
                </div>
            </div>
        @endif

        <div class="row">
            @if(IsConfig($config, 'postPublishedDate'))
                <x-admin.form.date-form name="published_at" value="{{old('published_at',$rowData->published_at)}}" col="12"/>
            @endif
            <x-admin.form.select-arr name="is_active" :sendvalue="old('is_active',IsArr($rowData,'is_active',1))" :label="__('admin/def.category_status')" col="12"
                                     type="selActive"/>
        </div>

        @if(IsConfig($config, 'postPhotoAdd'))
            <hr>
            <div class="row">
                <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="12"/>
            </div>
        @endif
    </x-admin.card.normal>
</div>
