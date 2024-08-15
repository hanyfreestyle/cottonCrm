@can($PrefixRole."_edit")
    @if(IsConfig($config, 'categorySort'))
        <x-admin.hmtl.section>
            <div class="row mb-3">
                <div class="col-12 dir_button">
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.CatSort',0)}}" type="sort" :tip="false" bg="dark"/>
                </div>
            </div>
        </x-admin.hmtl.section>
    @endif
@endcan
