<x-admin.card.normal :title="__('admin/proProduct.variant_card_title')">
  @if($errors->has([]))
    <div class="alert alert-danger alert-dismissible">
      {{__('admin/alertMass.form_has_error')}}
    </div>
  @endif

  <div class="row">
    <div class="col-lg-12">
      <form action="{{route('admin.Product.Product.UpdateVariants', $product->id)}}" method="post">
        <div class="d-flex">

          @csrf
          <ul class="list-unstyledX list_variant">
            <li class="d-flex mb-1">
              @foreach ($productAttr as $attrs)
                <div class="w-25 mr-1">{{$attrs->attributeName->name}}</div>
              @endforeach
              <div class="w-25 mr-1">{{__('admin/proProduct.pro_text_regular_price')}}</div>
              <div class="w-25 mr-1">{{__('admin/proProduct.pro_text_price')}}</div>
            </li>

            @foreach ($attributeValues as $key => $attrs)
              <li class="d-flex mb-1">
                @foreach ($attrs as $attr)
                  <input name="product_variants[{{$key}}][variants][]" class="w-25 form-control mr-1" value="{{$attributeValue[$attr]['name']}}" readonly>
                @endforeach

                @php
                  $id = "-"
                @endphp

                @foreach ($attrs as $attr)
                  <input name="product_variants[{{$key}}][variants_id][]" class="w-25 form-control mr-1" value="{{$attr}}" type="hidden">
                  @php
                    $id .= $attr."-"
                  @endphp
                @endforeach

                <input name="product_variants[{{$key}}][regular_price]" type="text" class="w-25 form-control mr-1"
                       value="{{ old("product_variants.$key.regular_price",$product->childproduct->where('variants_slug_id',$id)->first()->regular_price ?? '' ) }}">


                <input name="product_variants[{{$key}}][price]" type="text" class="w-25 form-control mr-1"
                       value="{{ old("product_variants.$key.price",$product->childproduct->where('variants_slug_id',$id)->first()->price ?? '' ) }}">

              </li>
              <div class="d-flex mb-1">
                <ul class="variants_error">
                  @if($errors->has('product_variants.'.$key.'.regular_price'))
                    <li>{{$errors->first('product_variants.'.$key.'.regular_price') }}</li>
                  @endif
                  @if($errors->has('product_variants.'.$key.'.price'))
                    <li>{{$errors->first('product_variants.'.$key.'.price') }}</li>
                  @endif
                </ul>
              </div>
            @endforeach
          </ul>
        </div>

        <div class="d-block col-lg-12">
          <x-admin.form.submit text="Update"/>
        </div>
      </form>
    </div>
  </div>

</x-admin.card.normal>
