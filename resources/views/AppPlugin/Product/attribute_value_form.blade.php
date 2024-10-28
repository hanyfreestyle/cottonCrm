@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <div class="row mb-3">
      <div class="col-5">
        <h1 class="def_h1_new">{!! print_h1($Attribute) !!}</h1>
      </div>
      <div class="col-7 dir_button">

        <x-admin.form.action-button url="{{route('admin.Product.ProAttribute.index')}}" :print-lable="__('admin/proProduct.att_but_attribute')"
                                    :tip="false" icon="fas fa-code-branch"/>
        <x-admin.form.action-button url="{{route('admin.Shop.ProAttributeValue.index',$Attribute->id)}}"
                                    :print-lable="__('admin/proProduct.att_but_value')" :tip="false" icon="fas fa-list-ol" bg="dark"/>
      </div>
    </div>
  </x-admin.hmtl.section>


  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="attribute_id" value="{{$Attribute->id}}">
        <div class="row">
          @foreach ( config('app.web_lang') as $key=>$lang )
            <div class="col-lg-6">
              <x-admin.form.trans-input name="name" :key="$key" :row="$rowData" :label="__('admin/form.text_name')" :tdir="$key" col="12"/>
              <x-admin.form.slug :viewtype="$pageData['ViewType']" :key="$key" :row="$rowData"/>
            </div>
          @endforeach
        </div>

        <hr>
        <div class="row">
          <x-admin.form.check-active :row="$rowData" :lable="__('admin/form.check_is_published')" name="is_active"
                                     page-view="{{$pageData['ViewType']}}"/>

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
