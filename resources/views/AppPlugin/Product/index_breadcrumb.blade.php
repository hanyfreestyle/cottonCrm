<x-admin.hmtl.breadcrumb :pageData="$pageData" :new-view="true">
    @if($pageData['ViewType'] == 'index')
        <div class="row mb-3">
            <div class="col-12 dir_button">
                @can($PrefixRole.'_add')
                    <a href="{{route($PrefixRoute.'.createNew') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> {{ __('admin/proProduct.app_menu_add_pro') }}
                    </a>
                @endcan

                @can($PrefixRole.'_restore')
                    @if($pageData['Trashed'] > 0 and $dataSend['PageView'] == 'index')
                        <a href="{{route($PrefixRoute.'.SoftDelete') }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> {{ __('admin/def.delete_restor_view') }}
                        </a>
                    @endif
                @endcan
                @if($dataSend['PageView'] == 'SoftDelete')
                    <a href="{{route($PrefixRoute.'.index') }}" class="btn btn-sm btn-primary">{{ __('admin/proProduct.app_menu_product') }}</a>
                @endif
                @can($PrefixRole.'_edit')
                    <a href="{{route($PrefixRoute.'.config') }}" class="btn btn-sm btn-dark adminButMobile"><i class="fas fa-cogs"></i></a>
                @endcan
            </div>
        </div>
    @endif
</x-admin.hmtl.breadcrumb>
