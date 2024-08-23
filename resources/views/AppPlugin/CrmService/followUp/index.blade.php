@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if(count($rowData) > 0 )
            <div class="row">
                @foreach($rowData as $row)
                    <x-app-plugin.crm-service.follow-up.box-view :row="$row" :open="false"/>
                @endforeach
            </div>
        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif
    </x-admin.hmtl.section>

@endsection

@push('JsCode')

@endpush
