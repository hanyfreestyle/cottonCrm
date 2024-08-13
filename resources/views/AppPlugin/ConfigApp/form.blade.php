@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.confirm-massage/>
  <form class="mainForm" action="{{route('admin.App.AppProfileUpdate')}}" method="post">
    @csrf
    <x-admin.hmtl.section>
      <div class="row">
        <input type="hidden" name="id" value="{{intval($menu->id)}}">
        <x-admin.card.normal col="col-lg-12" :title="$pageData['card']">
          @include('AppPlugin.ConfigApp.form_inc')
          <x-admin.form.submit text="Edit"/>

        </x-admin.card.normal>
      </div>
    </x-admin.hmtl.section>
  </form>

@endsection
