<div class="col-lg-12">
    <div class="form-group">
        @if(intval($filterid) == 0)
            <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_select_filter_lable')}}" name="filter_id"
                                     col="12" sendvalue="{{old('filter_id')}}" :send-arr="$filterTypes"/>
        @else

            @if(intval(issetArr($modelSettings,$controllerName."_select_filter_form",0)) == true)
                <x-admin.form.select-arr
                    :label="__('admin/config/upFilter.form_select_filter_lable')" :send-arr="$filterTypes" :labelview="false"
                    name="filter_id" col="12" :sendvalue="intval(issetArr($modelSettings,$controllerName.'_morephoto_filterid',0))"/>
            @else
                <input type="hidden" name="filter_id" value="{{ $filterid }}">
            @endif
        @endif
    </div>

    <div class="form-group">
        <label class="col-md-12 col-form-label">{{__('admin/def.form_photo_upload')}}
            <span class="required_Span">*</span>
        </label>
        <div class="col-md-12">
            <input class="form-control @error($fileName) is-invalid @enderror" type="file" name="{{$fileName}}[]" accept="image/*" multiple>
            @error($fileName)
            <span class="invalid-feedback" role="alert">
                    <strong>{{ \App\Helpers\AdminHelper::error($message,$fileName,$label) }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
