@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.confirm-massage/>

  <x-admin.hmtl.section>
    <div class="row">

      <x-admin.card.normal col="col-lg-6" :title="__('admin/configApp.photo_logo')">
        <form action="{{route($PrefixRoute.'.photoUpdate')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="cat_id" value="logo">
          <x-admin.form.upload-file view-type="Edit" fild-name="logo" :row-data="$setting" :multiple="false"/>

          <div>
            <x-admin.form.submit text="Edit"/>
          </div>
        </form>
      </x-admin.card.normal>

      <x-admin.card.normal col="col-lg-6" :title="__('admin/configApp.photo_side_logo')">
        <form action="{{route($PrefixRoute.'.photoUpdate')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="cat_id" value="SideLogo">
          <x-admin.form.upload-file view-type="Edit" fild-name="SideLogo"  :row-data="$setting" :multiple="false"/>

          <div>
            <x-admin.form.submit text="Edit"/>
          </div>
        </form>
      </x-admin.card.normal>

    </div>

  </x-admin.hmtl.section>


@endsection
