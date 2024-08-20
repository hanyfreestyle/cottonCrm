<div class="box_form">
    <input type="hidden" value="{{intval($rowData->id)}}" name="address_id">
    {{--    <input type="hidden" value="{{$Config['addCountry']}}" name="addAddress">--}}
    @if($title)
        <span class="box_title">{{$title}}</span>
    @endif


    <div class="row">
        @if( IsConfig( $config,'OneCountry'))
            <input type="hidden" value="{{$Config['defCountryId']}}" name="country_id">
        @else
            <x-admin.form.select-arr name="country_id" :sendvalue="old('country_id',issetArr($rowData,'country_id',IsConfig( $config,'defCountryId')))"
                                     add-filde="phone" :send-arr="$CashCountryList" label="{{__('admin/dataCity.form_country')}}" col="3"/>
        @endif


        <x-admin.form.select-arr name="city_id" sendvalue="{{old('city_id',$rowData->city_id)}}" :req="IsConfig( $config,'addressReq')"
                                 select-type="ajax" :required-span="false" :send-arr="$Citylist" label="{{__('admin/dataArea.form_sel_city')}}" col="3"/>

        <x-admin.form.select-arr name="area_id" sendvalue="{{old('area_id',$rowData->area_id)}}" :req="IsConfig( $config,'addressReq')"
                                 select-type="ajax" :required-span="false" :send-arr="$Arealist" label="{{__('admin/dataArea.form_sel_area')}}" col="3"/>
    </div>


    @if(IsConfig( $config,'fullAddress'))
        <div class="row">
            <x-admin.form.input name="address" :row="$rowData" :label="__($defLang.'form_ad_address')" col="6" tdir="ar" :req="IsConfig( $config,'addressReq')"/>
            <x-admin.form.input name="unit_num" :row="$rowData" :label="__($defLang.'form_ad_unit_num')" col="2" tdir="en" :req="false"/>
            <x-admin.form.input name="floor" :row="$rowData" :label="__($defLang.'form_ad_floor')" col="2" tdir="en" :req="false"/>
            @if(IsConfig( $config,'postcode'))
                <x-admin.form.input name="post_code" :row="$rowData" :label="__($defLang.'form_ad_post_code')" col="2" tdir="en" :req="false"/>
            @endif
        </div>

        @if(IsConfig( $config,'googleAddress'))
            <div class="row">
                <x-admin.form.input name="latitude" :row="$rowData" label="latitude" col="3" tdir="en" :req="false"/>
                <x-admin.form.input name="longitude" :row="$rowData" label="longitude" col="3" tdir="en" :req="false"/>
            </div>
        @endif

    @endif


</div>


@push('JsCode')
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
                        jQuery('select[name="area_id"]').empty();
                        $('select[name="area_id"]').append('<option value="">{{__('admin/dataArea.form_sel_area')}}</option>');
                        jQuery('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="">{{__('admin/dataArea.form_sel_city')}}</option>');
                        jQuery.each(response, function (key, value) {
                            $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    'error': function () {
                        jQuery('select[name="city_id"]').empty();
                        $('select[name="city_id"]').append('<option value="">{{__('admin/dataArea.form_sel_city')}}</option>');

                        jQuery('select[name="area_id"]').empty();
                        $('select[name="area_id"]').append('<option value="">{{__('admin/dataArea.form_sel_area')}}</option>');
                    }
                });
            });

            $('#city_id').change(function (event) {
                var idCity = this.value;
                $.ajax({
                    'url': "{{route('admin.api.fetch-area')}}",
                    'type': 'POST',
                    'dataType': 'json',
                    'data': {'city_id': idCity, _token: "{{csrf_token()}}"},
                    'success': function (response) {
                        jQuery('select[name="area_id"]').empty();
                        $('select[name="area_id"]').append('<option value="">{{__('admin/dataArea.form_sel_area')}}</option>');
                        jQuery.each(response, function (key, value) {
                            $('select[name="area_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    'error': function () {
                        jQuery('select[name="area_id"]').empty();
                        $('select[name="area_id"]').append('<option value="">{{__('admin/dataArea.form_sel_area')}}</option>');
                    }
                });
            });

        });
    </script>
@endpush
