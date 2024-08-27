@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if(count($rowData) > 0 )

            @foreach($rowData as $user => $val)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-dark">{{ $val->first()->user->name }}</div>
                    </div>
                     @foreach($val as $row)
                        <x-app-plugin.crm-service.cash.get-card :row="$row" :open="true"/>
                    @endforeach
                </div>
            @endforeach

        @else
            <x-admin.hmtl.alert-massage type="nodata"/>
        @endif
    </x-admin.hmtl.section>

@endsection






