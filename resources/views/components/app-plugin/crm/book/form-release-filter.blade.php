<div class="row">
    <div class="col-lg-9">
        <x-admin.card.normal>
{{--            <form action="{{route('admin.Periodicals.ReleaseReport.filter')}}" method="post">--}}
            <form action="{{route($PrefixRoute.'.filter')}}" method="post">
                @csrf

                <input type="hidden" name="formName" value="{{$formName}}">
                <div class="row">
                    <x-admin.form.select-multiple :has-trans="false" name="periodicals_id" :categories="$PeriodicalsList" :col="12"
                                                  :sel-cat="old('periodicals_id',issetArr($getSessionData,'periodicals_id'))"
                                                  :label="__('admin/Periodicals.filter_periodicals')" :req="false"/>

                    <x-admin.form.input name="year" :value="old('year',issetArr($getSessionData,'year'))" col="3" :labelview="false" :placeholder="true" label="السنة"/>

                    <x-admin.form.input name="month" :value="old('month',issetArr($getSessionData,'month'))" col="3" :labelview="false" :placeholder="true"
                                        label="الشهر"/>
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