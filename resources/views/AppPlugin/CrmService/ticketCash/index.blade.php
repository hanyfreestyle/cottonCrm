@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if(count($rowData) > 0 )
            <div class="row">
                @foreach($rowData as $row)
                    <x-app-plugin.crm-service.cash.get-card :row="$row" :open="true"/>
                @endforeach
            </div>
        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif
    </x-admin.hmtl.section>

@endsection






