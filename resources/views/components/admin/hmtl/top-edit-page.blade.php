<x-admin.hmtl.section>
    @if($pageData['ViewType'] == 'Edit')
        <div class="row mb-2">
            <div class="col-6">
                <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
            </div>
            <div class="col-6 dir_button">

                @if(IsConfig($config,'categoryWebSlug',null))
                    <x-admin.form.action-button url="{{route(IsConfig($config,'categoryWebSlug',null),$rowData->slug)}}"
                                                :l="__('admin/def.but_slug_view')" bg="dark" icon="fa fa-eye" :tip="false"/>
                @endif

                @if(isset($pageData['AddLang']) and $pageData['AddLang'] == true )
                    <x-admin.lang.add-new-button :row="$row" :tip="false"/>
                    <x-admin.lang.delete-button :row="$row"/>
                @endif


                @if(IsConfig($config,'TableMorePhotos',false))
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto" :tip="false"/>
                @endif

            </div>
        </div>
    @endif
</x-admin.hmtl.section>
