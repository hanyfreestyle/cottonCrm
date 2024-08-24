@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins-yajra :style="true"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-6">
                <x-admin.card.collapsed :open="true" :outline="true" bg="p" :title="__('admin/crm.model_h2_customer')">
                    <div class="row">
                        <x-admin.hmtl.info-div-list n="name" :row="$ticket->customer" col="col-lg-6 col-12"/>
                        <x-admin.hmtl.info-div-list n="mobile" :row="$ticket->customer" col="col-lg-3 col-6"/>
                        <x-admin.hmtl.info-div-list n="mobile_2" :row="$ticket->customer" col="col-lg-3 col-6"/>
                    </div>
                    @if(issetArr($config,'addCountry',false))
                        @foreach($ticket->customer->address as $address)
                            <div class="row">
                                @if(issetArr($config,'fullAddress',false))
                                    <x-admin.hmtl.info-div-list n="address" :row="$address" col="col-lg-7 col-12"/>
                                    <x-admin.hmtl.info-div-list n="unit_num" :row="$address" col="col-lg-3 col-6"/>
                                    <x-admin.hmtl.info-div-list n="floor" :row="$address" col="col-lg-2 col-6"/>
                                @endif
                                <x-admin.hmtl.info-div-list n="city_id" :row="$address" col="col-lg-4 col-6"/>
                                <x-admin.hmtl.info-div-list n="area_id" :row="$address" col="col-lg-4 col-6"/>
                            </div>
                        @endforeach
                    @endif
                </x-admin.card.collapsed>
            </div>

            <div class="col-lg-6">
                <x-admin.card.collapsed :open="true" bg="p" :title="__('admin/crm.model_h2_ticket')">
                    <div class="row">
                        <x-admin.hmtl.info-div-list n="created_at" :row="$ticket" col="col-lg-3 col-6"/>
                        <x-admin.hmtl.info-div-list n="follow_date" :row="$ticket" col="col-lg-3 col-6"/>
                        <x-admin.hmtl.info-div-list n="user_id" :row="$ticket" col="col-lg-6 col-12"/>
                        {{--                        <x-admin.hmtl.info-div-list n="open_type" :row="$ticket" col="col-lg-3 col-6"/>--}}
                        {{--                        <x-admin.hmtl.info-div-list n="follow_state" :row="$ticket" col="col-lg-3 col-6"/>--}}
                        <x-admin.hmtl.info-div-list n="sours_id" :row="$ticket" col="col-lg-3 col-6"/>
                        <x-admin.hmtl.info-div-list n="ads_id" :row="$ticket" col="col-lg-3 col-6"/>
                        <x-admin.hmtl.info-div-list n="device_id" :row="$ticket" col="col-lg-3 col-6"/>
                        <x-admin.hmtl.info-div-list n="brand_id" :row="$ticket" col="col-lg-3 col-6"/>
                    </div>

                    <div class="row">
                        <x-admin.hmtl.info-div-list n="notes_err" :row="$ticket" col="col-lg-6 col-12"/>
                        <x-admin.hmtl.info-div-list n="notes" :row="$ticket" col="col-lg-6 col-12"/>
                    </div>
                </x-admin.card.collapsed>

            </div>
        </div>


    </x-admin.hmtl.section>


@endsection

@push('JsCode')

@endpush

