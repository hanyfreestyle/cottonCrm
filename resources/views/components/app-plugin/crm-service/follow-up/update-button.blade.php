<div class="row">
    <div class="col-lg-12 TicketActionBut">
        <x-admin.form.action-button :l="__('admin/crm_service.but_update_finished')" bg="s" icon="fas fa-check"
                                    url="{{route($PrefixRoute.'.UpdateFinished',$ticket->id)}}" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_depends')" bg="w" icon="fas fa-cogs"
                                    url="{{route($PrefixRoute.'.UpdateDepends',$ticket->id)}}" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_postponed')" bg="dark" icon="fas fa-random"
                                    url="{{route($PrefixRoute.'.UpdatePostponed',$ticket->id)}}" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_cancellation')" bg="d" icon="fas fa-window-close"
                                    url="{{route($PrefixRoute.'.UpdateCancellation',$ticket->id)}}" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_rejected')" bg="d" icon="fas fa-thumbs-down"
                                    url="{{route($PrefixRoute.'.UpdateReject',$ticket->id)}}" :tip="false" size="m"/>

    </div>
</div>

