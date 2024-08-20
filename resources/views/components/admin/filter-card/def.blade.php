<x-admin.card.collapsed :open="isset($getSessionData)" :filter="true" :row="$row">
    <div class="row">
        <div class="col-lg-12">
            <form class="Filter_Form_Style" action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf
                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    @if($isActive)
                        <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',issetArr($getSessionData,'is_active',null))}}"
                                                 :labelview="false" select-type="selActiveFilter" label="{{__('admin/formFilter.fr_satus')}}" :required-span="false" col="2"/>
                    @endif
                    @if($formDates)
                        <x-admin.form.date type="fromDate" col="2" col-mobile="6" value="{{old('from_date',issetArr($getSessionData,'from_date'))}}"/>
                        <x-admin.form.date type="toDate" col="2" col-mobile="6" value="{{old('to_date',issetArr($getSessionData,'to_date'))}}"/>
                    @endif

                    {{$slot}}
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

                    @if($exportBut)
                        @can($PrefixRole."_export")
                            <form action="{{route($PrefixRoute.$exportRoute)}}" method="post">
                                @csrf
                                <input type="hidden" name="formName" value="{{$formName}}">
                                <button type="submit" name="Export" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> {{__('admin/formFilter.but_export')}}</button>
                            </form>
                            {{--                            @if($newRoute)--}}
                            {{--                                <form action="{{route($newRoute)}}" method="post">--}}
                            {{--                                    @csrf--}}
                            {{--                                    <input type="hidden" name="formName" value="{{$formName}}">--}}
                            {{--                                    <button type="submit" name="ExportNew" class="btn btn-primary btn-sm"><i class="fas fa-file-excel"></i> {{ $newRouteTxt}}--}}
                            {{--                                    </button>--}}
                            {{--                                </form>--}}
                            {{--                            @endif--}}
                        @endcan
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-admin.card.collapsed>

@push('JsCode')
    @if($formDates)
        <script>
            $('.FilterForm').daterangepicker({
                singleDatePicker: true,
                autoApply: false,
                autoUpdateInput: false,
                showDropdowns: true,
                minYear: 2022,
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
