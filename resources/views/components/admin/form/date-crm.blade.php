<div class="col-lg-{{$col}}">
    <div class="form-group">
        @if($labelview)
            <label class="def_form_label col-form-label font-weight-light">
                {{$label}}
                @if($req)
                    <span class="required_Span">*</span>
                @endif
            </label>
        @endif
        <div class="input-group">
            <div class="input-group-prepend ">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
            </div>
            <input type="text" id="{{$id}}" value="{{$value}}" {{$readonly}} placeholder="YYYY-MM-DD" name="{{$name}}"
                   class="form-control float-right DatePickerForm  @error($name) is-invalid @enderror">

            @error($name)
            <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>

@push('JsCode')
    <script>
        $('.DatePickerForm').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            autoUpdateInput: false,
            showDropdowns: false,
            minDate: new Date(),
            locale: {
                format: "YYYY-MM-DD",
                cancelLabel: 'Clear'
            },
        });


        $('.DatePickerForm').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });
    </script>
@endpush
