<x-admin.hmtl.section>
    <x-admin.card.normal>
        <div class="row">
            <x-admin.hmtl.info-div :t="__($defLang.'form_name')" :des="$row->name" col="4"/>
            <x-admin.hmtl.info-div :t="__($defLang.'form_des')" :des="$row->des" col="8"/>
        </div>
        <div class="row">
            <x-admin.hmtl.info-div :arr-data="$CashCountryList" :t="__($defLang.'form_country')" :des="$row->country_id" col="3"/>
            <x-admin.hmtl.info-div :arr-data="$configData" :t="__($defLang.'form_release_name')" :des="$row->release_id" col="3"/>
            <x-admin.hmtl.info-div :arr-data="$configData" :t="__($defLang.'form_lang')" :des="$row->lang_id" col="3"/>
            <x-admin.hmtl.info-div :t="__($defLang.'form_release_count')" :des="$row->release_count" col="3"/>
        </div>
    </x-admin.card.normal>
</x-admin.hmtl.section>
