<div class="row infoDiv">
    <div class="col-lg-12">
        <h2 class="bg-danger mass_notes">{{__('admin/crm_service.change_user_h2')}}</h2>
    </div>
    <div class="col-lg-12">
        <form action="{{route('admin.TicketOpen.changeUserUpdate' ,$row->id)}}" method="post">
            @csrf
            <x-app-plugin.crm-service.leads.user-select type="changeUser" :row="$row" col="12" :col-mobile="12" :labelview="false" :req="false"/>
            <div class="container-fluid">
                <x-admin.form.submit text="{{__('admin/crm_service.change_user_but')}}"/>
            </div>
        </form>
    </div>
</div>
<div class="InfoViewList">
    <x-app-plugin.crm-service.leads.lead-info :add-title="true"  :row="$row"/>
</div>
