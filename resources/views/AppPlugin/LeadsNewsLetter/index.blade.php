@extends('admin.layouts.app')
@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>

    <x-admin.main.filter-form form-name="{{$formName}}" :row="$rowData"/>

    <x-admin.card.def :page-data="$pageData">
      @if(count($rowData)>0)
        <div class="card-body table-responsive p-0">
          <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
            <thead>
            <tr>
              <th class="TD_20">#</th>
              <th>{{__('admin/leadsNewsLetter.t_email')}}</th>
              <th>{{__('admin/leadsNewsLetter.t_date_add')}}</th>
              <th></th>
              <x-admin.table.action-but po="top" type="delete"/>
            </tr>
            </thead>
            <tbody>
            @foreach($rowData as $row)
              <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->getFormatteDate()}}</td>
                <td>{!! is_active($row->export) !!}</td>
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
