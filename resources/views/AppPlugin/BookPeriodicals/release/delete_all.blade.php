@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-2">
            <div class="col-lg-12 dir_button">
                <x-admin.form.action-button url="{{route('admin.Periodicals.AddReleaseYears',$Periodicals->id)}}"
                                            :print-lable="__('admin/Periodicals.but_add_year_list')" icon="fas fa-layer-group" :tip="false"/>
                <x-admin.form.action-button url="{{route('admin.Periodicals.ListRelease',$Periodicals->id)}}" type="ListRelease" :tip="false"/>

            </div>
        </div>
    </x-admin.hmtl.section>

    <x-app-plugin.crm.book.periodicals-info :row="$Periodicals"/>

    <x-admin.hmtl.section>
        <form class="mainForm" action="{{route('admin.Periodicals.deleteAllReleaseConfirm',$Periodicals->id)}}" method="post">
            @csrf
            <div class="alert alert-warning alert-dismissible">
                {{__('admin/Periodicals.mass_confirm_delete')}}
            </div>
            <x-admin.form.submit bg="d" :text="__('admin/Periodicals.but_delete_release')"/>
        </form>
    </x-admin.hmtl.section>
@endsection
