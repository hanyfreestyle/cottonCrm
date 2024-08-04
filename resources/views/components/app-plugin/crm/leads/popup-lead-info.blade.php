<section class="content">
    <div class="modal fade" id="modal_{{$id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('admin/crm/leads.model_title')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body leadInfo InfoViewList">
                    <x-app-plugin.crm.customers.card-profile :row="$row->customer" :add-title="true" :soft-data="true" :config="$config"/>
                    <x-app-plugin.crm.leads.lead-info :add-title="true" :row="$row"/>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin/form.button_close')}}</button>
                </div>
            </div>
        </div>
    </div>
</section>
