@can($PrefixRole.'_filter')
    <x-admin.card.collapsed :open="isset($getSessionData)" :outline="false"
                            :title="__('admin/formFilter.box_total') .' '.number_format($row->count()) ">
        <div class="row">
            <div class="col-lg-12">

                <form class="Filter_Form_Style" action="{{route($PrefixRoute.'.filter')}}" method="post">
                    @csrf
                    <input type="hidden" name="formName" value="{{$formName}}">
                    <div class="row">
                        <x-admin.form.date name="from_date" col="2" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}" :label="__('admin/crm/ticket.filter_date_from')"
                                           :reqspan="false"/>
                        <x-admin.form.date name="to_date" col="2" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}" :label="__('admin/crm/ticket.filter_date_to')" :reqspan="false"/>
                        <x-admin.form.date name="follow_from" col="2" value="{{old('follow_from',issetArr($getSessionData,'follow_from'))}}" :label="__('admin/crm/ticket.filter_follow_from')"
                                           :reqspan="false"/>
                        <x-admin.form.date name="follow_to" col="2" value="{{old('follow_to',issetArr($getSessionData,'follow_to'))}}" :label="__('admin/crm/ticket.filter_follow_to')"
                                           :reqspan="false"/>
                    </div>

                    <div class="row">
                        @if(IsConfig($Config,'addCountry'))
                            @if(File::isFile(base_path('routes/AppPlugin/data/country.php')) )
                                @if($config['OneCountry'] == false )
                                    <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($getSessionData,'country_id'))" col="3" :labelview="false"
                                                             add-filde="phone" :send-arr="$CashCountryList" label="{{__('admin/def.form_country')}}" :req="false"/>
                                @endif
                            @endif

                            @if(File::isFile(base_path('routes/AppPlugin/data/city.php')) )
                                @if(count($cityList) > 0 )
                                    <x-admin.form.select-arr name="city_id" :sendvalue="old('city_id',issetArr($getSessionData,'city_id'))" :labelview="false"
                                                             :send-arr="$cityList" label="{{__('admin/dataArea.form_sel_city')}}" :req="false" col="2"/>
                                @endif
                            @endif

                            @if(File::isFile(base_path('routes/AppPlugin/data/area.php')) )
                                @if(issetArr($getSessionData,'city_id') and count($areaList) > 0 )
                                    <x-admin.form.select-arr name="area_id" :sendvalue="old('area_id',issetArr($getSessionData,'area_id'))" :labelview="false"
                                                             :send-arr="$areaList" label="{{__('admin/dataArea.form_sel_area')}}" :req="false" col="2"/>
                                @endif
                            @endif
                        @endif


                        <x-admin.form.select-data name="sours_id" cat-id="LeadSours" :sendvalue="old('sours_id',issetArr($getSessionData,'sours_id'))"
                                                  col="2" :active="IsConfig($config,'leads_sours_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_sours')"/>

                        <x-admin.form.select-data name="ads_id" cat-id="LeadCategory" :sendvalue="old('ads_id',issetArr($getSessionData,'ads_id'))"
                                                  col="2" :active="IsConfig($config,'leads_ads_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_ads')"/>

                        <x-admin.form.select-data name="device_id" cat-id="DeviceType" :sendvalue="old('device_id',issetArr($getSessionData,'device_id'))"
                                                  col="2" :active="IsConfig($config,'leads_device_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_divce')"/>

                        <x-admin.form.select-data name="brand_id" cat-id="BrandName" :sendvalue="old('brand_id',issetArr($getSessionData,'brand_id'))"
                                                  col="2" :active="IsConfig($config,'leads_brand_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_brand')"/>
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

            </div>


            {{--        <div class="col-lg-3 filter_box_total">--}}
            {{--            <div class="info-box mb-3 bg-success">--}}
            {{--                <span class="info-box-icon"><i class="fas fa-server"></i></span>--}}
            {{--                <div class="info-box-content">--}}
            {{--                    <span class="info-box-text">{{__('admin/formFilter.box_total')}}</span>--}}
            {{--                    <span class="info-box-number">{{number_format($row->count())}}</span>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}


        </div>
    </x-admin.card.collapsed>
@endcan


@push('JsCode')
    <script>
        $('.FilterForm').daterangepicker({
            singleDatePicker: true,
            autoApply: false,
            autoUpdateInput: false,
            showDropdowns: true,
            minYear: 2020,
            locale: {
                format: "YYYY-MM-DD",
                cancelLabel: 'Clear'
            },
            maxYear: parseInt(moment().format('YYYY'), 10),
        });

        $('.FilterForm').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });

        $('.FilterForm').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    </script>
@endpush
