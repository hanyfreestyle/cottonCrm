@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
        @csrf
        <div class="row">
          @foreach ( config('app.web_lang') as $key=>$lang )
            <div class="col-lg-{{getColLang(6)}}">

              <x-admin.form.trans-input name="title" :row="$rowData" :label="__('admin/configBranch.title')" :key="$key" :tdir="$key"/>

              <x-admin.form.trans-text-area name="address" :row="$rowData" :label="__('admin/configBranch.address')"
                                            :key="$key" :tdir="$key"/>

              <x-admin.form.trans-text-area name="phone" :row="$rowData" :label="__('admin/configBranch.phone')"
                                            :key="$key" tdir="en"/>

              <x-admin.form.trans-text-area name="work_hours" :row="$rowData" :label="__('admin/configBranch.work_hours')"
                                            :key="$key" :req="false" :tdir="$key"/>
            </div>

          @endforeach
        </div>

        <div class="row">
          <x-admin.form.input name="whatsapp" :row="$rowData" :label="__('admin/configBranch.whatsapp')" :req="false" tdir="en" col="4"/>
          <x-admin.form.input name="lat" :row="$rowData" label="Latitude" :req="false" tdir="en" col="4"/>
          <x-admin.form.input name="long" :row="$rowData" label="Longitude" :req="false" tdir="en" col="4"/>
        </div>


        <div class="row">
          <x-admin.form.input name="direction" :row="$rowData" label="Direction Url" :req="false" tdir="en" col="12"/>
        </div>
        <hr>

        <div class="row">
          <x-admin.form.check-active :row="$rowData" :lable="__('admin/def.status')" name="is_active"
                                     page-view="{{$pageData['ViewType']}}"/>
        </div>
        <hr>
        <x-admin.form.submit-role-back :page-data="$pageData"/>
      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection
