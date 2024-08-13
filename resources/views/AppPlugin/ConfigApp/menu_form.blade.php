@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :full-error="true">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($menu->id))}}" method="post">
                @csrf
                 @include('AppPlugin.ConfigApp.form_inc')
                <x-admin.form.submit-role-back :page-data="$pageData" />
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection
