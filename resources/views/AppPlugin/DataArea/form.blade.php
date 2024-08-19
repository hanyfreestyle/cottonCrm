@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :title="$pageData['BoxH1']">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    @if($AppPluginConfig['add_country']  and File::isFile(base_path('routes/AppPlugin/data/country.php')))

                        <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($rowData,'country_id',$AppPluginConfig['def_country']))"
                                                 :labelview="false" add-filde="phone" :send-arr="$CashCountryList" label="{{__('admin/dataCity.form_country')}}" col="3"/>

                        <x-admin.form.select-arr name="city_id" sendvalue="{{old('city_id',$rowData->city_id)}}" :labelview="false"
                                                 select-type="ajax" :send-arr="$citylist" label="{{__('admin/dataArea.form_sel_city')}}" col="3"/>
                    @else
                        <input type="hidden" name="country_id" value="{{$AppPluginConfig['def_country']}}">
                        @if(File::isFile(base_path('routes/AppPlugin/data/city.php')))
                            <x-admin.form.select-arr name="city_id" sendvalue="{{old('city_id',$rowData->city_id)}}" :labelview="false"
                                                     select-type="ajax" :send-arr="$citylist" label="{{__('admin/dataArea.form_sel_city')}}" col="3"/>
                        @else
                            <input type="hidden" name="city_id" value="{{$AppPluginConfig['def_city']}}">
                        @endif
                    @endif
                </div>


                <div class="row">
                    @foreach ( config('app.web_lang') as $key=>$lang )
                        <div class="col-lg-6">
                            <x-admin.lang.meta-tage-filde-light :row="$rowData" :key="$key" :des="false" :seo="$AppPluginConfig['seo']"/>
                        </div>
                    @endforeach
                </div>

                <hr>
                <div class="row">
                    <x-admin.form.check-active :row="$rowData" name="is_active" page-view="{{$pageData['ViewType']}}"/>
                </div>
                <hr>
                @if($AppPluginConfig['add_photo'])
                    <div class="row">
                        <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>
                    </div>
                    <hr>
                @endif

                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    <script>
        $(document).ready(function () {
            $('#country_id').change(function (event) {
                var idCountry = this.value;
                $.ajax({
                    'url': "{{route('admin.api.fetch-city')}}",
                    'type': 'POST',
                    'dataType': 'json',
                    'data': {'country_id': idCountry, _token: "{{csrf_token()}}"},
                    'success': function (response) {
                        jQuery('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="">{{__('admin/dataArea.form_sel_city')}}</option>');
                        jQuery.each(response, function (key, value) {
                            $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    'error': function () {
                        jQuery('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="">{{__('admin/dataArea.form_sel_city')}}</option>');
                    }
                });
            });
        });
    </script>
@endpush
