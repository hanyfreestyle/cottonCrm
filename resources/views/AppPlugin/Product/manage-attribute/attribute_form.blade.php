@if(count($attributes) > 0)
  <x-admin.card.normal>
    <form class="mainForm" action="{{route('admin.Shop.Product.manage-attributeUpdate',$product->id)}}" method="post">
      @csrf
      <x-admin.form.select-multiple name="attributes" :categories="$attributes" :col="12"/>
      <x-admin.form.submit text="Add"/>
    </form>
  </x-admin.card.normal>
@endif

@if(count($product->attributes) > 0)
  <div class="col-lg-12">

    @if($errors->has([]))
      <div class="alert alert-danger alert-dismissible">
        {{__('admin/alertMass.form_has_error')}}
      </div>
    @endif


    <form class="mainForm" action="{{route('admin.Shop.Product.value-update')}}" method="post">
      @foreach($product->attributes as $attribute)
        <x-admin.card.normal :title="$attribute->name">
          @csrf
          <input type="hidden" name="ids[]" value="{{$attribute->pivot->id}}">
          <div class="row py-2">
            <div class="col-lg-11">
              <select id="{{$attribute->pivot->id}}" class="select2 is-invalid" multiple="multiple" name="attributes_values[{{$attribute->pivot->id}}][]" data-placeholder=""
                      style="width: 100%;">
                @foreach($attribute->Values as $category )
                  <option value="{{$category->id}}"
                  @if(is_array(json_decode($attribute->pivot->values, true)))
                    {{ (in_array($category->id,json_decode($attribute->pivot->values, true))) ? 'selected' : ''}}
                   @endif
                   {{ (collect(old('attributes_values.'.$attribute->pivot->id))->contains($category->id)) ? 'selected':'' }}>{{ print_h1($category)}}</option>
                @endforeach
              </select>
              @error('attributes_values.'.$attribute->pivot->id)
              <div class="invalid-feedback" role="alert">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="col-lg-1">
              <a  class="btn btn-danger" href="{{route('admin.Shop.Product.remove-attribute',[$product->id,$attribute->id])}}">{{__('admin/form.button_delete')}}</a>
            </div>
          </div>
        </x-admin.card.normal>
      @endforeach
      <div class="col-lg-12">
        <x-admin.form.submit text="Update"/>
      </div>
   </form>
  </div>
@endif