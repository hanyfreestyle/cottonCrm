@extends('admin.layouts.app')

@section('StyleFile')

@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="__('admin/crm/leads.box_customer_data')" :open="true" :outline="false" :collapsed="true">
            <x-app-plugin.crm.customers.card-profile :row="$customer" :soft-data="true" :config="$Config"/>
        </x-admin.card.collapsed>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.collapsed :title="__('admin/crm/leads.but_add_ticket')" :collapsed="false">
            <x-admin.form.print-error-div :full-err="false"/>
            <form action="{{route($PrefixRoute.'.createTicket',$customer->id)}}" method="post">
                @csrf
                <div class="row">
                    <x-admin.form.select-data name="sours_id" cat-id="LeadSours" :active="IsConfig($Config,'leads_sours_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_sours')"/>
                    <x-admin.form.select-data name="ads_id" cat-id="LeadCategory" :active="IsConfig($Config,'leads_ads_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_ads')"/>
                    <x-admin.form.select-data name="device_id" cat-id="DeviceType" :active="IsConfig($Config,'leads_device_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_divce')"/>
                    <x-admin.form.select-data name="brand_id" cat-id="BrandName" :active="IsConfig($Config,'leads_brand_id')" :l="false" :label="__('admin/crm/ticket.fr_lead_brand')"/>
                    {{--                    <x-admin.form.select-arr name="gender_id" select-type="DefCat" :send-arr="$DefCat['gender']" :label="__($defLang.'form_gender')" col="3" :req="false"/>--}}
                </div>

                <div class="row">
                    <x-admin.form.date-crm name="follow_date"  :label="__('admin/crm/ticket.fr_follow_date')" value="{{old('follow_date')}}" col="3"/>
                </div>
                <div class="container-fluid">
                    <x-admin.form.submit text="Add"/>
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

