@extends('admin.layouts.app')

@section('content')

  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">

      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
          <div class="row">
            <x-admin.form.input :row="$rowData" name="iso2" label="ISO2" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="iso3" label="ISO3" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="fips" label="FIPS" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="iso_numeric" label="ISO Numeric" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="phone" label="Phone Code" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="symbol" label="Symbol" tdir="en" col="2"/>
          </div>

          <div class="row">
            <x-admin.form.input :row="$rowData" name="currency_code" label="Currency Code" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="continent_code" label="Continent Code" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="language_codes" label="Language Code" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="top_level_domain" label="Top Level Domain" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="time_zone" label="Time Zone" tdir="en" col="2"/>
            <x-admin.form.input :row="$rowData" name="area_km" label="Area KM2" tdir="en" col="2"/>
          </div>

        </div>


        <div class="col-lg-12">
          <div class="row">
            @foreach ( config('app.web_lang') as $key=>$lang )
              <div class="col-lg-{{getColLang(6)}}">
                <div class="row">

                  <x-admin.form.trans-input name="name" :row="$rowData" :key="$key" :label="__('admin/form.text_name')" :tdir="$key"
                                            :col="getColLang(6,6)"/>

                  <x-admin.form.trans-input name="capital" :row="$rowData" :key="$key" :label="__('admin/dataCountry.t_capital')"
                                            :tdir="$key" :col="getColLang(6,6)"/>

                </div>
                <div class="row">
                  <x-admin.form.trans-input name="currency" :row="$rowData" :key="$key" :label="__('admin/dataCountry.t_currency')"
                                            :tdir="$key" :col="getColLang(4,4)"/>

                  <x-admin.form.trans-input name="nationality" :row="$rowData" :key="$key" :label="__('admin/dataCountry.t_nationality')"
                                            :tdir="$key" :col="getColLang(4,4)"/>

                  <x-admin.form.trans-input name="continent" :row="$rowData" :key="$key" :label="__('admin/dataCountry.t_continent')"
                                            :tdir="$key" :col="getColLang(4,4)"/>
                </div>

                @if(config('AppPlugin.Country.seo'))
                  <div class="row">
                    <x-admin.form.trans-input name="g_title" :row="$rowData" :key="$key" :label="__('admin/form.text_g_title')" :tdir="$key"/>
                    <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$rowData" :label="__('admin/form.text_g_des')" :tdir="$key"/>
                    <x-admin.form.trans-input name="slug" :key="$key" :row="$rowData" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        <hr>
        <x-admin.form.submit-role-back :page-data="$pageData"/>
      </form>

    </x-admin.card.def>
  </x-admin.hmtl.section>

@endsection

@push('JsCode')
  <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
@endpush