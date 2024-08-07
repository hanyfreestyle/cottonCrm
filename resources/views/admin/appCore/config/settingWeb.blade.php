@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <form class="mainForm" action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf
        <x-admin.hmtl.section>
            <div class="row">
                <x-admin.card.normal col="col-lg-12" title="{{__('admin/config/webConfig.app_menu')}}">
                    <div class="row">
                        <div class="col-lg-12">
                            @if($errors->has([]) )
                                <div class="alert alert-danger alert-dismissible">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <x-admin.web-config.form model="def" :row="$setting"  />
                    </div>
                </x-admin.card.normal>

                    <div class="col-lg-12">
                        <div class="row">
                            <x-admin.web-config.form model="product" col="col-lg-6" :row="$setting"  />
                            <x-admin.web-config.form model="schema" col="col-lg-6" :row="$setting"  />
                            <x-admin.web-config.form model="social" col="col-lg-6" :row="$setting"  />
                            <x-admin.web-config.form model="telegram" col="col-lg-6" :row="$setting"  />
                        </div>
                    </div>


                <div class="col-lg-12">
                    <div class="row">



                    </div>
                </div>


            </div>
            <div class="mb-5">
                <x-admin.form.submit text="Edit"/>
            </div>

        </x-admin.hmtl.section>
    </form>

@endsection
