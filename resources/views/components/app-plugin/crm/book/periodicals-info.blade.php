<x-admin.hmtl.section>
    <x-admin.card.normal>
        <div class="row">
            <x-admin.hmtl.info-div :t="__($defLang.'form_name')" :des="$row->name" col="4"/>
            <x-admin.hmtl.info-div :t="__($defLang.'form_des')" :des="$row->des" col="8"/>
        </div>
        <div class="row">
            <x-admin.hmtl.info-div :arr-data="$CashCountryList" :t="__($defLang.'form_country')" :des="$row->country_id" col="3"/>
            <x-admin.hmtl.info-div :arr-data="$configData" :t="__($defLang.'form_release_name')" :des="$row->release_id" col="3"/>
            <x-admin.hmtl.info-div :arr-data="$configData" :t="__($defLang.'form_lang')" :des="$row->lang_id" col="2"/>
            <x-admin.hmtl.info-div :t="__($defLang.'form_release_count')" :des="$row->release_count" col="2"/>
            <x-admin.hmtl.info-div :t="__($defLang.'form_release_repeat')" :des="$row->release_sum_repeat" col="2"/>
        </div>
        @if($row->release_count > 0)
            <div class="row">
                <div class="infoDiv col-lg-12">
                    <div class="title">السنوات </div>
                    <div class="des">
                        @foreach($row->release->groupBy('year') as $key => $val)
                            <span class="year">{{$key}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </x-admin.card.normal>
</x-admin.hmtl.section>