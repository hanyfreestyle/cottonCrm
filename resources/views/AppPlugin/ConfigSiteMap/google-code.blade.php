@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :page-data="$pageData"/>
    @include('AppPlugin.ConfigSiteMap.menu')

    <x-admin.hmtl.section>
        <x-admin.form.print-error-div/>
        <div class="col-lg-12">
            <form class="mainForm" action="{{route($PrefixRoute.".GoogleCodeUpdate")}}" method="post">
                @csrf
                <div class="row mt-3">
                    <x-admin.card.normal  :outline="false" bg="d" icon="fas fa-code"  title="Update Google Codes">
                        <div class="row mb-5">
                            <x-admin.form.input :row="$googleCode" name="tag_manager_code" label="Tag Manager Code" col="6" tdir="en" :req="false"/>
                            <x-admin.form.input :row="$googleCode" name="analytics_code" label="Google Analytics Code " col="6" tdir="en" :req="false"/>
                            <x-admin.form.input :row="$googleCode" name="web_master_html" label="Web Master Html " col="6" tdir="en" :req="false"/>
                            <x-admin.form.input :row="$googleCode" name="web_master_meta" label="Web Master Meta" col="6" tdir="en" :req="false"/>
                            <x-admin.form.input :row="$googleCode" name="google_api" label="Google API" col="6" tdir="en" :req="false"/>
                        </div>
                    </x-admin.card.normal>
                </div>
                <button type="submit" class="btn float-left mb-5 btn-primary">{{__('admin/configSitemap.f_but_update')}}</button>
            </form>
        </div>
    </x-admin.hmtl.section>
@endsection

