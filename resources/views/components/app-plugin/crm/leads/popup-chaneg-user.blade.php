<section class="content">
    <div class="modal fade" id="modal_user_{{$id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('admin/crm/ticket.fr_change_but')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body leadInfo">

                    <div class="row InfoViewList">
                        <div class="col-lg-12">
                            <h2 class="h2_info bg-danger des">{{__('admin/crm/ticket.fr_change_h2')}}</h2>
                        </div>

                    </div>
                    <form action="{{route('admin.TicketFollowUp.changeUserUpdate' ,$row->id)}}" method="post">
                        @csrf
                        <x-app-plugin.crm-service.leads.user-select type="changeUser" :row="$row" col="12" :col-mobile="12" :labelview="false" :req="false"/>
                        <div class="container-fluid mt-3 mb-5">
                            <x-admin.form.submit  text="{{__('admin/crm/ticket.fr_change_but')}}"/>
                        </div>
                    </form>
                    <div class="InfoViewList">
                        <x-app-plugin.crm-service.leads.lead-info :add-title="true" :row="$row"/>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin/form.button_close')}}</button>
                </div>
            </div>
        </div>
    </div>
</section>
