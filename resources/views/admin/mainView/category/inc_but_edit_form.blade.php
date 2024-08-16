@if($pageData['ViewType'] == 'Edit')
    <div class="row mb-2">
        <div class="col-6">
            <h1 class="def_h1_new">{!! print_h1($rowData) !!}</h1>
        </div>
        <div class="col-6 dir_button">
            @if(IsConfig($config,'categoryWebSlug',null))
                <x-admin.form.action-button url="{{route(IsConfig($config,'categoryWebSlug',null),$rowData->slug)}}"
                                            :l="__('admin/def.but_slug_view')" bg="dark" icon="fa fa-eye" :tip="false"/>
            @endif

            @if(IsConfig($config,'categoryDelete',false))
                @can($PrefixRole.'_delete')
                    <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.destroyEdit',$rowData->id)}}" :tip="false" type="deleteSweet"/>
                @endcan
            @endif

            @if(IsConfig($config,'categoryAddOnlyLang',false))
                <x-admin.lang.delete-button :row="$rowData"/>
                <x-admin.lang.add-new-button :tip="false" :row="$rowData"/>
            @endif

        </div>
    </div>
@endif
