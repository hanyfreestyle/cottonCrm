@extends('admin.layouts.app')

@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  @can($PrefixRole."_edit")
    <x-admin.hmtl.section>
      <div class="row mb-3">
        <div class="col-7">
          <h1 class="def_h1_new">{!! print_h1($Attribute) !!}</h1>
        </div>
        <div class="col-5 dir_button">
          <x-admin.form.action-button url="{{route($PrefixRoute.'.Sort',$Attribute->id)}}" type="sort" :tip="false" bg="dark"/>
        </div>
      </div>
    </x-admin.hmtl.section>
  @endcan

  <x-admin.hmtl.section>

    <x-admin.card.def :page-data="$pageData">

      @if(count($rowData)>0)
        <div class="card-body table-responsive p-0">
          <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
            <thead>
            <tr>
              <th class="TD_20">#</th>
              @foreach(config('app.web_lang') as $key => $lang)
                <th class="TD_200">{{__('admin/form.text_name')}}  {{printLableKey($key)}}</th>
              @endforeach
              <th class="TD_20"></th>
              <x-admin.table.action-but po="top" type="edit"/>
              <x-admin.table.action-but po="top" type="delete"/>
            </tr>
            </thead>
            <tbody>
            @foreach($rowData as $row)
              <tr>
                <td>{{$row->id}}</td>
                @foreach(config('app.web_lang') as $key => $lang)
                  <td>{!! printCategoryName($key,$row,$PrefixRoute.".SubCategory") !!}</td>
                @endforeach
                <td>{!! is_active($row->is_active) !!}</td>
                <x-admin.table.action-but type="edit" :row="$row"/>
                <x-admin.table.action-but type="delete" :row="$row"/>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.def>
    <x-admin.hmtl.pages-link :row="$rowData"/>

  </x-admin.hmtl.section>
@endsection

@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush

