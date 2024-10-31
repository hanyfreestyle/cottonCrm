<x-admin.card.collapsed :open="isset($getSessionData)" :filter="true" :row="$row">
    <div class="row">
        <div class="col-lg-12">

            <form action="{{route($PrefixRoute.$defRoute)}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    <x-admin.form.select-multiple name="category_ids" :categories="$CashCategoriesList"
                                                  :sel-cat="old('category_ids',issetArr($getSessionData,'category_ids'))" :col="9"/>
                </div>

                <div class="row">



                    <x-admin.form.select-arr name="brand_id" :sendvalue="old('brand_id',issetArr($getSessionData,'brand_id'))" :send-arr="$CashBrandList"
                                             :l="__('admin/proProduct.app_menu_brand')" col="3" :labelview="false"/>

                    <x-admin.form.select-arr name="on_stock" sendvalue="{{old('on_stock',issetArr($getSessionData,'on_stock'))}}" :labelview="false"
                                             :send-arr="$OnStock_Arr" label="{{__('admin/proProduct.pro_status_stock')}}" col="3"/>

                    <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',issetArr($getSessionData,'is_active'))}}" :labelview="false"
                                             :send-arr="$IsActive_Arr" label="{{__('admin/proProduct.pro_status_is_active')}}" col="3"/>

                    <x-admin.form.select-arr name="type" sendvalue="{{old('type',issetArr($getSessionData,'type'))}}" :send-arr="$ProductType_Arr"
                                             label="{{__('admin/proProduct.pro_type')}}" col="3" :labelview="false"/>

                </div>
                <div class="row">
                    <x-admin.form.input name="price_from" :value="old('price_from',issetArr($getSessionData,'price_from'))" col="3" :labelview="false" :placeholder="true"
                                        :label="__('admin/proProduct.pro_filter_price_from')"/>

                    <x-admin.form.input name="price_to" :value="old('price_to',issetArr($getSessionData,'price_to'))" col="3" :labelview="false" :placeholder="true"
                                        :label="__('admin/proProduct.pro_filter_price_to')"/>
                </div>
                <div class="row">
                    <x-admin.form.input name="name" :value="old('name',issetArr($getSessionData,'name'))" col="9" :labelview="false" :placeholder="true"
                                        :label="__('admin/proProduct.pro_text_name')"/>
                </div>

                <div class="row">
                    @if($fromDate)
                        <x-admin.form.date type="fromDate" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}" :labelview="false"/>
                    @endif

                    @if($toDate)
                        <x-admin.form.date type="toDate" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}" :labelview="false"/>
                    @endif

                </div>

                <div class="row formFilterBut">
                    <button type="submit" name="Forget" class="btn btn-dark btn-sm adminButMobile"><i class="fas fa-filter"></i> {{__('admin/formFilter.but_filter')}}</button>
                </div>
            </form>


            @if(isset($getSessionData))
                <div class="row formForgetBut">
                    <form action="{{route('admin.ForgetSession')}}" method="post">
                        @csrf
                        <input type="hidden" name="formName" value="{{$formName}}">
                        <button type="submit" name="Forget" class="btn btn-danger btn-sm adminButMobile"><i class="fas fa-trash-alt"></i> {{__('admin/formFilter.but_clear')}}</button>
                    </form>
                </div>
            @endif


        </div>
    </div>

</x-admin.card.collapsed>




@push('JsCode')
    @if($fromDate)
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
    @endif

@endpush
