<div class="row">
    @if(Session::has('data_not_save'))
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                {!!  __('admin/alertMass.confirm_not_save') !!}
            </div>
        </div>
    @endif
    <x-admin.card.normal col="col-lg-12">
        <form class="mainForm UpdateTicketForm" action="{{route($PrefixRoute.'.UpdateTicketStatus',$ticket->id)}}" method="post">
            <input type="hidden" name="follow_state" value="{{$followState}}">
            <input type="hidden" name="open_type" value="{{$ticket->open_type}}">
            <input type="hidden" name="ticket_follow_state" value="{{$ticket->follow_state}}">
            <input type="hidden" name="cash_amount" value="{{$ticket->paymentCash->amount ?? 0}}">
            @csrf

            @if($followState == 2)
                <x-admin.hmtl.alert-massage bg="s" margin="mt-3" align="right" :mass="__('admin/crm_service_mass.state_2')"/>
                <div class="row mt-2">
                    @if($ticket->follow_state == 3)
                        <div class="infoDiv col-lg-6">
                            <div class="title"><i class="fas fa-hand-holding-usd"></i> {{__('admin/crm_service.label_update_deposit')}}</div>
                            <div class="des">{!! returnDepositInfo($ticket) !!}</div>
                        </div>
                    @endif
                    <x-admin.form.input :type="getNumberType($agent)" name="amount" col="6" :value="old('amount')" :label="__('admin/crm_service.label_update_cost')"/>
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_update_works_done')"/>
                </div>

            @elseif($followState == 3)
                <x-admin.hmtl.alert-massage bg="w" margin="mt-3" align="right" :mass="__('admin/crm_service_mass.state_3')"/>
                <div class="row mt-2">
                    <x-admin.form.input :type="getNumberType($agent)" name="amount" col="3" :value="old('amount')" :label="__('admin/crm_service.label_update_deposit')"/>
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
                @if($ticket->follow_state == 3)
                    <x-admin.hmtl.alert-massage bg="dark" margin="mt-3 " align="right" :mass="__('admin/crm_service_mass.state_6_3')"/>
                    <div class="row mt-2">
                        <div class="infoDiv col-lg-6">
                            <div class="title"><i class="fas fa-hand-holding-usd"></i> {{__('admin/crm_service.label_update_deposit')}}</div>
                            <div class="des">{!! returnDepositInfo($ticket) !!}</div>
                        </div>
                        <x-admin.form.input :type="getNumberType($agent)" name="amount" col="3" :value="old('amount')" :label="__('admin/crm_service.label_update_cost_service')"/>
                    </div>
                @else
                    <x-admin.hmtl.alert-massage bg="dark" margin="mt-3 " align="right" :mass="__('admin/crm_service_mass.state_6')"/>
                    <div class="row mt-2">
                        <x-admin.form.input :type="getNumberType($agent)" name="amount" col="3" :value="old('amount')" :label="__('admin/crm_service.label_update_cost_service')"/>
                    </div>
                @endif
                <div class="row">
                    <x-admin.form.textarea col="12" name="des" :value="old('des')" :label="__('admin/crm_service.label_reason_for_rejection')"/>
                </div>
            @endif
            <x-admin.form.submit-cancel :back-to="route($PrefixRoute.'.UpdateTicket',$ticket->uuid)"/>
        </form>
    </x-admin.card.normal>
</div>
