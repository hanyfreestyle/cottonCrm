<div class="{{$noLabel}} form-group col-lg-{{$col}} {{$style}} MobilePhone">
    @if ($labelview)
        <label class="def_form_label col-form-label label_{{$dir}} font-weight-light" for="{{$id}}">
            {{$label}}
            @if($req)
                <span class="required_Span">*</span>
            @endif
        </label>
    @endif

    <input id="{{$id}}" name="{{$name}}" class=" form-control MobilePhone {{$inputclass}} @error($name) is-invalid @enderror" value="{{$value}}"
           @if($placeholder) placeholder="{{$label}}" @endif >
    @error($name)
    <div class="invalid_feedback_Div" role="alert">
        {!! \App\Helpers\AdminHelper::error($message,$name,$label) !!}
    </div>
    @enderror
</div>

<input type="hidden" name="countryCode_{{$id}}" id="countryCode_{{$id}}">
<input type="hidden" name="countryDialCode_{{$id}}" id="countryDialCode_{{$id}}" dir="ltr">
<input type="hidden" name="form_id" value="{{$id}}" dir="ltr">

@section('StyleFile')
    <link rel="stylesheet" href="{{ defAdminAssets('intlTelInput/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('intlTelInput/css/custom.css') }}">
@endsection

@section('AddScript')
    <script src="{{ defAdminAssets('intlTelInput/js/intlTelInput_'.thisCurrentLocale().'.js') }}"></script>
@endsection

@push('JsCode')
    <script>
        const {{$id}} = document.querySelector("#{{$id}}");
        const countryCode{{$id}} = document.querySelector("#countryCode_{{$id}}");
        const countryDialCode{{$id}} = document.querySelector("#countryDialCode_{{$id}}");
        const iti{{$id}} = window.intlTelInput({{$id}}, {
            initialCountry: "{{old('countryCode_'.$id,$initialCountry)}}",
            containerClass: "containerClass",
            countrySearch: false,
            preferredCountries: ['eg', "sa", 'ae', 'kw', 'qa', 'bh', 'om', 'jo', '', 'us'],
            onlyCountries: [{!! $onlyCountriesList !!}],
            excludeCountries: ["il"],
            fixDropdownWidth: true,
            formatAsYouType: true,
            nationalMode: true,
            formatOnDisplay: true,
            autoInsertDialCode: true,
            showFlags: true,
            showSelectedDialCode: false,
        });
        countryCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().iso2;
        countryDialCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().dialCode;
        {{$id}}.addEventListener('countrychange', () => {
            countryCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().iso2;
            countryDialCode{{$id}}.value = iti{{$id}}.getSelectedCountryData().dialCode;
        });
    </script>
@endpush
