<div class="row">
    <x-admin.card.normal col="col-lg-12">
        @foreach ( $LangAdd as $key=>$lang )
            <div class="row">
                <x-admin.lang.meta-tage-seo print-type="Seo" :lang-add="$LangAdd" :viewtype="$pageData['ViewType']" :row="$rowData" :key="$key"/>
            </div>
        @endforeach
    </x-admin.card.normal>
</div>
