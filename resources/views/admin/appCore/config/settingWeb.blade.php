@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <form class="mainForm" action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf
        <x-admin.hmtl.section>
            <x-admin.form.print-error-div :full-err="true"/>
            <div class="row">
                <x-admin.web-config.form model="def" :row="$setting"/>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <x-admin.web-config.form model="product" col="col-lg-6" :row="$setting"/>
                        <x-admin.web-config.form model="schema" col="col-lg-6" :row="$setting"/>
                        <x-admin.web-config.form model="social" col="col-lg-6" :row="$setting"/>
                        <x-admin.web-config.form model="telegram" col="col-lg-6" :row="$setting"/>
                    </div>
                </div>
            </div>


            <div class="mb-5">
                <x-admin.form.submit text="Edit"/>
            </div>

        </x-admin.hmtl.section>
    </form>

@endsection
