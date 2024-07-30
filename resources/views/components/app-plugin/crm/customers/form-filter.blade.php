<div class="row">
    <div class="col-lg-9">
        <x-admin.card.normal>
            <form action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">

                    @if($Config['addCountry'])
                        @if(File::isFile(base_path('routes/AppPlugin/data/country.php')) )
                            @if($config['OneCountry'] == false )
                                <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($getSessionData,'country_id'))" col="3"
                                                         add-filde="phone" :send-arr="$CashCountryList" label="{{__('admin/def.form_country')}}" :req="false"/>
                            @endif
                        @endif

                        @if(File::isFile(base_path('routes/AppPlugin/data/city.php')) )
                            @if(count($cityList) > 0 )
                                <x-admin.form.select-arr name="city_id" :sendvalue="old('city_id',issetArr($getSessionData,'city_id'))" :labelview="false"
                                                         :send-arr="$cityList" label="{{__('admin/dataArea.form_sel_city')}}" :req="false" col="3"/>
                            @endif
                        @endif

                        @if(File::isFile(base_path('routes/AppPlugin/data/area.php')) )
                            @if(issetArr($getSessionData,'city_id') and count($areaList) > 0 )
                                <x-admin.form.select-arr name="area_id" :sendvalue="old('area_id',issetArr($getSessionData,'area_id'))" :labelview="false"
                                                         :send-arr="$areaList" label="{{__('admin/dataArea.form_sel_area')}}" :req="false" col="3"/>
                            @endif
                        @endif
                    @endif

                    @if($Config['evaluation'])
                        <x-admin.form.select-data name="evaluation_id" sendvalue="{{old('evaluation_id',issetArr($getSessionData,'evaluation_id'))}}"  :labelview="false"
                                                  cat-id="EvaluationCust" :label="__($defLang.'form_evaluation')" :filter-form="true" :req="false"/>
                    @endif

                    @if($Config['gender'])
                        <x-admin.form.select-arr name="gender_id" sendvalue="{{old('gender_id',issetArr($getSessionData,'gender_id'))}}" :labelview="false"
                                                 select-type="DefCat" :send-arr="$DefCat['gender']" col="3" :label="__($defLang.'form_gender')" :filter-form="true" :req="false"/>
                    @endif
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
