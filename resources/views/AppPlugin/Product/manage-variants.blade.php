@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.product.form-top-icon :page-data="$pageData" :row="$product"/>

  <div class="productForm">
    <x-admin.hmtl.section>

      @include('AppPlugin.Product.manage-variants_form_new')

{{--      @if(count($product->childproduct) == 0 )--}}
{{--        @include('AppPlugin.Product.manage-variants_form_new')--}}

{{--      @else--}}
{{--        @foreach($product->childproduct as $variants)--}}

{{--          {{$variants->id}}--}}

{{--        @endforeach--}}
{{--      @endif--}}


    </x-admin.hmtl.section>
  </div>
@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>
@endpush
