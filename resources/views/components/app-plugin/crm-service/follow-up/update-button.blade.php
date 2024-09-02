<div class="row mt-3">
    <div class="col-lg-12 TicketActionBut">
        <x-admin.form.action-button :l="__('admin/crm_service.but_update_finished')" bg="s" icon="fas fa-check"
                                    url="{{route($PrefixRoute.'.UpdateFinished',$ticket->uuid)}}" :tip="false" size="m"/>

        @if($ticket->follow_state != 3)
            <x-admin.form.action-button :l="__('admin/crm_service.but_update_depends')" bg="w" icon="fas fa-cogs"
                                        url="{{route($PrefixRoute.'.UpdateDepends',$ticket->uuid)}}" :tip="false" size="m"/>
        @endif

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_postponed')" bg="dark" icon="fas fa-random"
                                    url="{{route($PrefixRoute.'.UpdatePostponed',$ticket->uuid)}}" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_cancellation')" bg="d" icon="fas fa-window-close"
                                    url="{{route($PrefixRoute.'.UpdateCancellation',$ticket->uuid)}}" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_rejected')" bg="d" icon="fas fa-thumbs-down"
                                    url="{{route($PrefixRoute.'.UpdateReject',$ticket->uuid)}}" :tip="false" size="m"/>

    </div>
</div>


