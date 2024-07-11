@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-lg-12 dir_button">
                <x-admin.form.action-button url="{{route('admin.Periodicals.ListRelease',$Periodicals->id)}}" type="ListRelease" :tip="false"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-app-plugin.crm.book.periodicals-info :row="$Periodicals"/>

    <x-admin.form.form-def :form-route="route('admin.Periodicals.AddYearReleaseForm',intval($Periodicals->id))" :row-data="$PeriodicalsRelease" :page-data="$pageData">
        <div class="box_form mt-4">
            <span class="box_title">{{$pageData['BoxH1']}}</span>
            <div class="row">
                <input type="hidden" name="periodicals_id" value="{{$Periodicals->id}}">
                <x-admin.form.input name="year" :label="__($defLang.'form_release_year')" col="2" tdir="ar"/>
            </div>

            <div class="col-lg-12">
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <input id="checkAll" class="icheck-primaryX d-inline  amenity_checkbox" type="checkbox">
                        <label for="checkAll"></label>
                        <span class="font-weight-bold" style="color: red">{{__('admin/form.check_all')}}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                @for ($i = 1; $i <= 12 ; $i++)
                    <div class="col-lg-6">
                        <div class="row">
                            <input name="yearslist[]" id="{{$i}}" class="icheck-primaryX d-inline  amenity_checkbox" value="{{$i}}" type="checkbox">
                            <x-admin.form.input name="number[]" :disabled="true" :value="$i" :label="__($defLang.'form_release_num')" col="2" tdir="ar"/>
                            <x-admin.form.input name="notes__{{$i}}" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_notes')" col="5" tdir="ar" :req="false"/>
                            <x-admin.form.input name="repeat_{{$i}}" :row="$PeriodicalsRelease" :label="__($defLang.'form_release_repeat')" col="3" tdir="ar" :req="false"/>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <x-admin.form.submit :text="$pageData['ViewType']"/>
    </x-admin.form.form-def>

@endsection

@push('JsCode')
    <script>
        $("#checkAll").click(function () {
            $('.amenity_checkbox:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
