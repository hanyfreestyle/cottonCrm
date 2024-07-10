<div class="row">
    <div class="col-lg-9">
        <x-admin.card.normal>
            <form action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">

                    <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($getSessionData,'country_id'))" col="3"
                                             add-filde="phone" :send-arr="$CashCountryList" label="{{__('admin/def.form_country')}}" :required-span="false"/>


                    <x-admin.form.select-data name="release_id" :sendvalue="old('release_id',issetArr($getSessionData,'release_id'))"
                                              :filter-form="true" cat-id="BookRelease" :label="__($defLang.'form_release_name')" :req="false"/>

                    <x-admin.form.select-data name="lang_id" :sendvalue="old('lang_id',issetArr($getSessionData,'lang_id'))"
                                              :filter-form="true" cat-id="BookLang" :label="__($defLang.'form_lang')" :req="false"/>

                </div>
                <div class="row formFilterBut">
                    <button type="submit" name="Forget" class="btn btn-dark btn-sm"><i class="fas fa-filter"></i> {{__('admin/formFilter.but_filter')}}</button>
                </div>
            </form>


            @if(isset($getSessionData))
                <div class="row formForgetBut">
                    <form action="{{route('admin.ForgetSession')}}" method="post">
                        @csrf
                        <input type="hidden" name="formName" value="{{$formName}}">
                        <button type="submit" name="Forget" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> {{__('admin/formFilter.but_clear')}}</button>
                    </form>
                </div>
            @endif
        </x-admin.card.normal>
    </div>
    <div class="col-lg-3 filter_box_total">
        <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="fas fa-server"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{__('admin/formFilter.box_total')}}</span>
                <span class="info-box-number">{{number_format($row->count())}}</span>
            </div>
        </div>
    </div>
</div>
