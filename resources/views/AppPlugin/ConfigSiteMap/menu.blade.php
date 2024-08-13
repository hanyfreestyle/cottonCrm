@section('StyleFile')
    <style>
        #robots {
            direction: ltr;
            min-height: 450px;
            font-size: 13px;
        }
        @media (max-width: 600px) {
            .siteMapBut .tipName {
                display: none;

            }
        }
    </style>
@endsection
<x-admin.hmtl.section>
    <div class="siteMapBut col-lg-12 mb-3">
        <x-admin.form.action-button :url="route($PrefixRoute.'.index')" :tip="false" l="Update Site Map" size="m" icon="fas fa-sitemap" bg="p"/>
        <x-admin.form.action-button :url="route($PrefixRoute.'.Robots')" :tip="false" l="Update Robots" size="m" icon="fas fa-robot" bg="i"/>
        <x-admin.form.action-button :url="route($PrefixRoute.'.GoogleCode')" :tip="false" l="Update Google Code" size="m" icon="fas fa-code" bg="d"/>
    </div>
</x-admin.hmtl.section>
