@extends('admin.layouts.app')
@section('content')

    <x-admin.hmtl.breadcrumb :page-data="$pageData"/>
    @include('AppPlugin.ConfigSiteMap.menu')

    <x-admin.hmtl.section>
        <x-admin.form.print-error-div/>
        <div class="col-lg-12 mb-5">
            <form class="m-0 p-0" action="{{route($PrefixRoute.".RobotsUpdate")}}" method="post">
                @csrf
                <div class="row mt-3 siteMapRobots">
                    <x-admin.card.normal :outline="false" bg="i" icon="fas fa-robot" title="Update Robots">
                        <div class="row mb-5">
                            <x-admin.form.textarea :row="$googleCode" name="robots" :value="old('robots',$googleCode->robots)" id="robots" label="" col="12" dir="en" :req="false"/>
                        </div>
                    </x-admin.card.normal>
                </div>
                <button type="submit" class="btn mb-5 float-left btn-primary">{{__('admin/configSitemap.f_but_update')}}</button>
            </form>
        </div>
    </x-admin.hmtl.section>
@endsection

