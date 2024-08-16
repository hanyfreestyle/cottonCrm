<x-admin.card.normal col="col-lg-12">
    @if($pageData['ViewType'] == 'Edit')
        <div class="row LeftSideInfo">
            <div class="col-lg-12">
                <div class="info">{{__('admin/def.lable_date_add')}} : <span> {{ PrintDate($rowData->created_at) }}</span></div>
                <div class="info">{{__('admin/def.lable_date_update')}} : <span>{{ PrintDate($rowData->updated_at , "Y-m-d H:i:s") }}</span></div>
            </div>

        </div>

    @endif

    @if(IsConfig($config, 'categoryTree'))
        <div class="row">
            <x-admin.form.select-category name="parent_id" label="{{__('admin/form.sel_categories')}}"
                                          :sendvalue="old('parent_id',$rowData->parent_id)" :req="false" col="col-lg-12 "
                                          :send-arr="$Categories"/>
        </div>
    @endif
    <div class="row">
        <x-admin.form.select-arr name="is_active" :sendvalue="old('is_active',IsArr($rowData,'is_active',1))" :label="__('admin/def.category_status')" col="12" type="selActive"/>
    </div>
    @if(IsConfig($config, 'categoryPhotoAdd'))
        <hr>
        <div class="row">
            <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="12"/>
            @if(IsConfig($config, 'categoryIcon'))
                <hr>
                <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="12" file-name="icon" db-name="icon"
                                                 filter-input-name="IconFilter" filter-name="_iconfilterid" route=".emptyIcon"/>
            @endif

        </div>
    @endif
</x-admin.card.normal>
