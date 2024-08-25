<div class="row">
    <div class="col-lg-12">
        <x-admin.form.action-button :l="__('admin/crm_service.but_update_finished')" bg="s" icon="fas fa-check"
                                    url="" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_depends')" bg="w" icon="fas fa-cogs"
                                    url="" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_postponed')" bg="dark" icon="fas fa-random"
                                    url="" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_cancellation')" bg="d" icon="fas fa-window-close"
                                    url="" :tip="false" size="m"/>

        <x-admin.form.action-button :l="__('admin/crm_service.but_update_rejected')" bg="d" icon="fas fa-thumbs-down"
                                    url="" :tip="false" size="m"/>

    </div>
</div>
