<div class="row">

    {{--    <div class="col-lg-12">--}}
    {{--        <x-admin.form.print-error-div/>--}}
    {{--    </div>--}}
    <x-admin.card.normal col="col-lg-12">
        <form class="mainForm UpdateTicketForm" action="{{route($PrefixRoute.'.UpdateTicketStatus',$ticket->id)}}" method="post">
            <input type="hidden" name="follow_state" value="{{$followState}}">
            @csrf

            @if($followState == 2)
                <x-admin.hmtl.alert-massage bg="s" margin="mt-3" align="right" :mass="__('admin/crm_service_mass.state_2')"/>
                <div class="row mt-2">
                    <x-admin.form.input :type="getNumberType($agent)" name="cost" :value="old('cost')" :label="__('admin/crm_service.label_update_cost')"/>
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_update_works_done')"/>
                </div>

            @elseif($followState == 3)
                <x-admin.hmtl.alert-massage bg="w" margin="mt-3" align="right" :mass="__('admin/crm_service_mass.state_3')"/>
                <div class="row mt-2">
                    <x-admin.form.input :type="getNumberType($agent)" name="deposit" col="3" :value="old('deposit')" :label="__('admin/crm_service.label_update_deposit')"/>
                    <x-admin.form.date-crm name="follow_date" :readonly="true" :label="__('admin/crm.label_date_follow')" value="{{old('follow_date')}}" col="3"/>
                </div>
                <div class="row">
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_update_spare_parts')"/>
                </div>

            @elseif($followState == 4)
                <x-admin.hmtl.alert-massage bg="dark" margin="mt-3" align="right" :mass="__('admin/crm_service_mass.state_4')"/>

                <div class="row mt-2">
                    <x-admin.form.date-crm name="follow_date" :readonly="true" :label="__('admin/crm.label_date_follow')" value="{{old('follow_date')}}" col="3"/>
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_reason_for_postponement')"/>
                </div>
            @elseif($followState == 5)
                <x-admin.hmtl.alert-massage bg="dark" margin="mt-3" align="right" :mass="__('admin/crm_service_mass.state_5')"/>
                <div class="row mt-2">
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_reason_for_cancellation')"/>
                </div>
            @elseif($followState == 6)
                <x-admin.hmtl.alert-massage bg="dark" margin="mt-3 " align="right" :mass="__('admin/crm_service_mass.state_6')"/>
                <div class="row mt-2">
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_reason_for_rejection')"/>
                </div>
            @endif
            <x-admin.form.submit-cancel :back-to="route($PrefixRoute.'.UpdateTicket',$ticket->id)"/>
        </form>
    </x-admin.card.normal>
</div>