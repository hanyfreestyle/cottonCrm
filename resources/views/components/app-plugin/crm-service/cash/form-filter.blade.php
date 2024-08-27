<div class="row mb-3">
    <div class="col-lg-12">
        <form class="Filter_Form_Style" action="{{route($PrefixRoute.$defRoute)}}" method="post">
            @csrf
            <input type="hidden" name="formName" value="{{$formName}}">
            <div class="row">
                <input type="hidden" name="crm_cash_filter" value="1">
                <x-admin.form.date name="from_date" col="2"
                                   value="{{old('from_date',issetArr($getSessionData,'from_date',saveOnlyDate()))}}"
                                   :label="__('admin/crm_service_cash.filter_date_from')" :re :reqspan="false"/>


                <x-admin.form.date name="to_date" col="2" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}"
                                   :label="__('admin/crm_service_cash.filter_date_to')" :reqspan="false"/>

                <x-app-plugin.crm-service.leads.user-select :col-mobile="6" :col="2" type="tech" :labelview="true" :req="false"
                                                            :sendvalue="old('user_id',issetArr($getSessionData,'user_id'))"/>

                <x-admin.form.select-arr name="amount_type" sendvalue="{{old('amount_type',issetArr($getSessionData,'amount_type'))}}"
                                         select-type="DefCat" :send-arr="$DefCat['CrmServiceCashType']" col="2" :label="__('admin/crm_service_cash.label_amount_type')"
                                         :filter-form="true" :req="false"/>

            </div>
            <div class="row formFilterBut">
                <button type="submit" name="Forget" class="btn btn-dark adminButMobile btn-sm"><i class="fas fa-filter"></i> {{__('admin/formFilter.but_filter')}}</button>
            </div>
        </form>
        @if(isset($getSessionData))
            <div class="row formForgetBut">
                <form action="{{route('admin.ForgetSession')}}" method="post">
                    @csrf
                    <input type="hidden" name="formName" value="{{$formName}}">
                    <button type="submit" name="Forget" class="btn btn-danger adminButMobile btn-sm"><i class="fas fa-trash-alt"></i> {{__('admin/formFilter.but_clear')}}</button>
                </form>
            </div>
        @endif
    </div>

</div>


@push('JsCode')
    <script>
        $('.FilterForm').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            autoUpdateInput: true,
            showDropdowns: true,
             minYear: 2020,
            locale: {
                format: "YYYY-MM-DD",
                cancelLabel: 'Clear'
            },

        });

        $('.FilterForm').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });

        $('.FilterForm').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    </script>
@endpush
