@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-12 dir_button">
                @can('crm_customer_edit')
                    <x-admin.form.action-button url="{{route('admin.CrmCustomer.profile',$customer->id)}}" :tip="false" type="Profile"/>
                    <x-admin.form.action-button url="{{route('admin.CrmCustomer.edit',$customer->id)}}" :tip="false" type="edit"/>
                @endcan
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="__('admin/crm.model_h2_customer')" :open="true" :outline="false" :collapsed="true">
            <x-app-plugin.crm.customers.card-profile :row="$customer" :soft-data="true" :config="$config"/>
        </x-admin.card.collapsed>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="$pageData['BoxH1']" :collapsed="false">
            <x-admin.form.print-error-div :full-err="false"/>
            <form class="mainForm" action="{{route($PrefixRoute.$form_route,$UpdateId)}}" method="post">
                @csrf
                <div class="row">

                    <x-admin.form.select-arr name="open_type" sendvalue="{{old('open_type',issetArr($_POST,'open_type',1))}}" :labelview="false"
                                             select-type="DefCat" :send-arr="$DefCat['CrmServiceOpenType']"
                                             :label="__('admin/crm_service_var.open_type')" col="2"/>

                    <x-admin.form.select-data name="sours_id" :sendvalue="old('sours_id',$ticketInfo->sours_id)" cat-id="LeadSours" col="2"
                                              :active="IsConfig($config,'leads_sours_id')" :l="false" :label="__('admin/crm.label_lead_sours')"/>

                    <x-admin.form.select-data name="ads_id" :sendvalue="old('ads_id',$ticketInfo->ads_id)" cat-id="LeadCategory" col="2"
                                              :active="IsConfig($config,'leads_ads_id')" :l="false" :label="__('admin/crm.label_lead_category')"/>

                    <x-admin.form.select-data name="device_id" :sendvalue="old('device_id',$ticketInfo->device_id)" cat-id="DeviceType" col="2"
                                              :active="IsConfig($config,'leads_device_id')" :l="false" :label="__('admin/crm_service.label_device')"/>

                    <x-admin.form.select-data name="brand_id" :sendvalue="old('brand_id',$ticketInfo->brand_id)" cat-id="BrandName" col="2"
                                              :active="IsConfig($config,'leads_brand_id')" :l="false" :label="__('admin/crm_service.label_brand')"/>
                </div>

                <div class="row">
                    <x-admin.form.date-crm name="follow_date" :label="__('admin/crm.label_date_follow')" value="{{old('follow_date',$followDate)}}" col="3"/>
                    @can($PrefixRole."_distribution")
                        <x-app-plugin.crm-service.leads.user-select type="tech" col-mobile="12" :req="false"/>
                    @endcan
                </div>
                <div class="row">
                    <x-admin.form.textarea :row="$ticketInfo" name="notes_err" :value="old('notes_err',$ticketInfo->notes_err)" :label="__('admin/crm_service.label_notes_err')" col="6" tdir="ar"/>
                    <x-admin.form.textarea :row="$ticketInfo" name="notes" :value="old('notes',$ticketInfo->notes)" :label="__('admin/crm.label_notes')" col="6" :req="false" tdir="ar"/>
                </div>

                <div class="container-fluid mt-3 mb-5">
                    <x-admin.form.submit :text=" $pageData['ViewType']"/>
                </div>
            </form>

        </x-admin.card.collapsed>
    </x-admin.hmtl.section>

@endsection

@push('JsCode')
    <script>


        $(function () {
            $('#hanyDarwish').datetimepicker({
                ignoreReadonly: true,
                format: 'YYYY-MM-DD',

                todayHighlight: true,
                useCurrent: false,
                minDate: new Date(),

            });

        });


    </script>
@endpush

