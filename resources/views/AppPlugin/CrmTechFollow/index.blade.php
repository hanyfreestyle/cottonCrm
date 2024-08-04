@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>

        @if(count($rowData) > 0 )
            <div class="row">
                @foreach($rowData as $row)
                    <x-app-plugin.crm.ticket.tech-follow-up-box :row="$row" :open="true"/>
                @endforeach
            </div>
        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif


    </x-admin.hmtl.section>

@endsection

@push('JsCode')

@endpush

