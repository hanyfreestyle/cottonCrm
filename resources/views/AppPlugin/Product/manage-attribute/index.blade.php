@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.product.form-top-icon :page-data="$pageData" :row="$product"/>

  @if(count($attributeValues)>1)
    <x-admin.hmtl.section>
      <div class="row">
        @include('AppPlugin.Product.manage-attribute.variants_form')
      </div>
    </x-admin.hmtl.section>

    @if(count($product->childproduct) > 0)
      <x-admin.hmtl.section>
        <div class="row col-lg-12">
          <a href="#" id="{{route('admin.Shop.Product.RemoveVariants',$product->id)}}" class="btn btn-danger sweet_daleteBtn_noForm" > حذف الخصائص واعادة التخصيص</a>
        </div>
      </x-admin.hmtl.section>

    @endif


  @endif

  <x-admin.hmtl.section>
    <div class="row mb-5">
      @if(count($product->childproduct) == 0)
        @include('AppPlugin.Product.manage-attribute.attribute_form')
      @endif
    </div>
  </x-admin.hmtl.section>

@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>

@endpush
